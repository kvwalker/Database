<!DOCTYPE html>
<!--
	Telephasic by HTML5 UP	html5up.net | @n33co	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)-->
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Customer Profile</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.dropotron.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-layers.min.js"></script>
    <script src="js/init.js"></script> <noscript>
			<link rel="stylesheet" href="css/skel.css">
			<link rel="stylesheet" href="css/style.css">
		</noscript>
    <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
  </head>
  <body class="right-sidebar">
    <!-- Header -->
    <div id="header-wrapper">
      <div id="header" class="container">
        <!-- Logo -->
        <h1 id="logo"><a href="index.html">Eat Here</a></h1>
        <!-- Nav -->
        <nav style="top: 0px; height: 19px;" id="nav">
          <ul>
            <li>
              <form method="post" action="Search.php"><input name = "business_name" placeholder="Search business" required="" type="text"></form>
            </li>
            <li class="break"><br>
            </li>
            <li class="break"> Welcome!
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- Main -->
    <div class="wrapper">
      <div class="container" id="main">
        <div class="row 150%">
          <div class="8u 12u(narrower)">
            <!-- Content -->
            <article id="content">
              <header>
                <h2>Customer Profile </h2>
                <!---Name:<br>
                Email <span style="color: #f35858;"><br>
                </span>
                <h5><span style="color: #f35858;"> Date Created: </span> </h5>-->
                <?php
                		$servername = "localhost";
              		  $username = "ashriver";
                		$password = "secret15";
                		$dbname = "ashriver";

                		// Create connection
                		$conn = new mysqli($servername, $username, $password, $dbname);
                		// Check connection
                		if ($conn->connect_error) {
                		    die("Connection failed: " . $conn->connect_error);
                		} 

                		$email= $_GET["email"];

                    $sql = "SELECT * FROM CustomerProfile WHERE customerprofile_email = '$email'";

                    $result = $conn->query($sql);

                		if($result->num_rows > 0)
                		{

              			   while ($row = $result->fetch_assoc()) {
              	           echo "Name: ";
              	           echo "<td>".$row["first_name"]." ".$row["middle_initial"]." ".$row["last-name"]."</td>";
                           echo "<br>Email: ";
      	                   echo "<td>".$row["customerprofile_email"]."</td>";
       	                   echo "<br>Date Created: ";
       	                   echo "<td>".$row["date_created"]."</td>";
              	       }
              	    }
                    $conn->close();
                ?>
                <br>
                <br>
                <h2>Blacklisted Users</h2>
                
                <?php
                    $servername = "localhost";
                    $username = "ashriver";
                    $password = "secret15";
                    $dbname = "ashriver";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 

                    $email= $_GET["email"];

                    $sql = "SELECT blocked_email FROM blackList WHERE reporter_email = '$email'";

                    $result = $conn->query($sql);

                    if($result->num_rows > 0)
                    {

                       while ($row = $result->fetch_assoc()) {
                           echo "Email of user: ";
                           echo "<td>".$row["blocked_email"]."</td>";
                           echo "<br>";
                       }
                    }else{
                      echo "You have not blacklisted anyone.<br>";
                    }

                    echo("<a href=\"Blacklist.php?email=".$email."\">"."Click here to blacklist."."</a>");

                    echo"<ul><br><br></ul>";
                    $conn->close();
                ?>
                

              </header>
            </article>
          </div>
          <div class="4u 12u(narrower)">
            <!-- Sidebar -->
            <section id="sidebar">
              <section>
                <header>
                  <h2 style="text-align: center;">Reviewed</h2>
                  <?php
                    $servername = "localhost";
                    $username = "ashriver";
                    $password = "secret15";
                    $dbname = "ashriver";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 

                    $email= $_GET["email"];

                    $sql2 = "SELECT BusinessProfile.business_name, Comments.comment_txt, Comments.date_created, Comments.number_of_stars
                            FROM Comments, customerCommented, businessCommented, BusinessProfile
                            WHERE customerCommented.customer_email = '$email' AND customerCommented.comment_number = Comments.comment_number
                            AND businessCommented.comment_number = customerCommented.comment_number AND businessCommented.business_number = BusinessProfile.business_number
                            ORDER BY date_created desc
                          ";

                    if($result = $conn->query($sql2))
                    {

                       while ($row = $result->fetch_assoc()) {
                          echo "Business: ";
                          echo "<td>".$row["business_name"]."</td>";
                          echo "<br>Date Created: ";
                          echo "<td>".$row["date_created"]."</td>";
                          echo "<br>Rating: ";
                          echo "<td>".$row["number_of_stars"]."</td>";  
                          echo "<br>Comment: ";
                          echo "<td>".$row["comment_txt"]."</td>";
                          echo "<br><br>";
                        }

                    }

                    $sql3 = "SELECT count(customerCommented.customer_email) as count
                            FROM customerCommented
                            WHERE customerCommented.customer_email = '$email'
                            ORDER BY customer_email";
                    if($result = $conn->query($sql3)){
                      while ($row = $result->fetch_assoc()) {
                        echo "<td>"."You have reviewed ".$row['count']." businesses."."<br></td>";
                      }
                    }    

                    $sql4 = "SELECT min(number_of_stars) as min
                              FROM Comments, customerCommented
                              WHERE customerCommented.customer_email = '$email' AND customerCommented.comment_number = Comments.comment_number";
                              //ORDER BY business_number";


                    /*SELECT BusinessProfile.business_name, min(Comments.number_of_stars) as min
                            FROM Comments, customerCommented, businessCommented, BusinessProfile
                            WHERE customerCommented.customer_email = '$email' AND customerCommented.comment_number = Comments.comment_number
                            AND Comments.number_of_stars = min(Comments.number_of_stars)
                            AND businessCommented.comment_number = customerCommented.comment_number AND businessCommented.business_number = BusinessProfile.business_number
                            ORDER BY number_of_stars desc";*/
                    if($result = $conn->query($sql4)){
                      while ($row = $result->fetch_assoc()) {
                        echo "<td>"."Your lowest rating is ".$row['min']." stars."."</td>";
                      }
                    }    

                    
                     $conn->close();

                  ?>
                   
                </header>
              </section>
            </section>
          </div>
        </div>
      </div>
    </div>
    <div id="promo-wrapper">
      
      <section id="promo">
        
          <form method="post" action="Search.php">
            <h3>Search For a Business </h3>
            <input name="business_name" placeholder="Business Name" type="text">
            <ul class="actions"><br>
              <li><input value="Search" type="submit"> </li>
            </ul>
          </form>
        
      </section>
      
      <section id="promo">
        
          <form method="post" action="#">
            <h3>Follow Other User</h3>
            <input name="friend_email" placeholder="Users Email" type="text">
            <ul class="actions">
              <li><input value="Follow User" type="submit" name="followSubmit"> </li>
              <li><input value="List of Users" type="submit" name="showSubmit"> </li>
            </ul>
          </form>

        <?php
                    $servername = "localhost";
                    $username = "ashriver";
                    $password = "secret15";
                    $dbname = "ashriver";
                    $email= $_GET["email"];


                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 

                    if(isset($_POST['followSubmit'])) 
                    {

                    
                      // Enter the Code you want to execute after the form has been submitted
                      $followEmail = $_POST['friend_email'];

                      $sql1 = "SELECT customerprofile_email FROM CustomerProfile
                              WHERE customerprofile_email = '$followEmail'";
                      $result1 = $conn->query($sql1);

                      if($result1->num_rows > 0){
                        $sql = "INSERT INTO followers (follower, followed) values ('$email', '$followEmail')";
                        if($result = $conn->query($sql)){
                        header('refresh:3, url=FollowUser.php?email='.$email);
                        echo "Your request has been submitted. Please check on the next page to ensure you have followed the correct email.";
                        }else{
                        echo "You are already following that email. Please try again.";
                        }
                      }else{
                        echo "This email doesn't exist. Please try again.";
                      }

                    }
                    else if(isset($_POST['showSubmit']))             
                    {
                        header('refresh:0, url=FollowUser.php?email='.$email);
                    }

                    $conn->close();
              ?>

      </section>
    </div>
      
      <div id="footer-wrapper">
        <div id="footer" class="container">
          <header class="major">
            <h2>Message Another User<br>
            </h2>
          </header>
          <div class="row">
            <section class="6u 12u(narrower)">
              <form method="post" action="#"> 
                <input name="receiverEmail" placeholder="Email" type="text"><br>
                <div class="row 50%">
                  <div class="12u"> <textarea name="message" placeholder="Message"></textarea>
                  </div>
                </div>
                <div class="row 50%">
                  <div class="12u">
                    <ul class="actions">
                      <li><input value="Send Message" type="submit" name="sendMessage"></li>
                      <li><input value="Clear form" type="reset"></li>
                    </ul>
                  </div>
                </div>
              </form>

              <div class="row 50%">
                  <div class="12u">
                    <?php
                    $servername = "localhost";
                    $username = "ashriver";
                    $password = "secret15";
                    $dbname = "ashriver";
                    $email= $_GET["email"];


                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 

                    if(isset($_POST['sendMessage'])) 
                    {

                    
                      // Enter the Code you want to execute after the form has been submitted
                      $receiverEmail = $_POST['receiverEmail'];
                      $message = $_POST['message'];

                      $sql = "INSERT INTO messages VALUES ('', '$email', '$receiverEmail', NOW(), '$message' )";

                      if($result = $conn->query($sql)){
                        //header('refresh:3, url=CustomerProfile.php?email='.$email);
                        

                        //$sql2 = "SELECT message_sender_email, message_receiver_email, time_stamp, message_content FROM messages WHERE message_sender_email = '$email' OR message_receiver_email = '$email' ORDER BY time_stamp DESC";
                        
                          $sql2 = "SELECT messages.message_sender_email, messages.message_receiver_email, messages.time_stamp, messages.message_content
                            FROM messages
                            WHERE messages.message_sender_email = '$email' OR messages.message_receiver_email = '$email'
                            ORDER BY time_stamp desc
                          ";
                        $result2 = $conn->query($sql2);

                        echo "The message has been sent.";

                        if($result2->num_rows > 0)
                        {

                          while ($row = $result2->fetch_assoc()) {
                           echo "<br>From: ";
                           echo "<td>".$row["message_sender_email"]."</td>";
                           echo "       To: ";
                           echo "<td>".$row["message_receiver_email"]."</td>";
                           echo "       Date Sent: ";
                           echo "<td>".$row["time_stamp"]."</td>";
                           echo "<br>";
                           echo "<td>".$row["message_content"]."</td>";
                           echo "<br>_________________________________________________";
                           }
                        }else{
                          echo "No Messages";
                        }


                      }else{
                        echo "The message has not been sent. Please refresh the page and try again.";
                      }
                      // Dispaly Success or failure Message if any 
                    }
                    else               
                    {
                        $sql2 = "SELECT messages.message_sender_email, messages.message_receiver_email, messages.time_stamp, messages.message_content
                            FROM messages
                            WHERE messages.message_sender_email = '$email' OR messages.message_receiver_email = '$email'
                            ORDER BY time_stamp desc
                          ";
                        $result2 = $conn->query($sql2);


                        if($result2->num_rows > 0)
                        {

                          while ($row = $result2->fetch_assoc()) {
                           echo "<br>From: ";
                           echo "<td>".$row["message_sender_email"]."</td>";
                           echo "       To: ";
                           echo "<td>".$row["message_receiver_email"]."</td>";
                           echo "       Date Sent: ";
                           echo "<td>".$row["time_stamp"]."</td>";
                           echo "<br>";
                           echo "<td>".$row["message_content"]."</td>";
                           echo "<br>_________________________________________________";
                           }
                        }else{
                          echo "No Messages";
                        }
                    }

                    
                    


                    $conn->close();
              ?>
                  </div>
                </div>
            </section>
          </div>
        </div>
      </div>
  </body>
</html>

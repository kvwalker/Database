<!DOCTYPE html>
<!--
	Telephasic by HTML5 UP	html5up.net | @n33co	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)-->
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Business Profile </title>
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
    <!-- Body -->
    <div class="wrapper">
      <div class="container" id="main">
        <div class="row 150%">
          <div class="8u 12u(narrower)">
            <!-- Content -->
            <article id="content">
              <header class="major">
<h2 style="text-align: center;"><?php echo htmlspecialchars($_GET["name"])?></h2>
          <!---<div style="text-align: left;">Cuisine Type: <br>
            Phone Number:<br>
            Email:<br>
            Address:&nbsp;<span style="font-style: italic;"> </span><br>
            <div style="margin-left: 40px;"><span style="font-style: italic;">&nbsp;Number
                &nbsp;&nbsp; Street </span><br>
              <span style="font-style: italic;"> City, State Zip Code<br>-->
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

    $name= $_GET["name"];
    $name = addslashes($name);

    $sql = "SELECT * FROM BusinessProfile WHERE business_name = '$name'";

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
                     echo "<br>Cuisine Type: ";
                     echo "<td>".$row["cuisine_type"]."</td>";
                     echo "<br>Phone Number: ";
                     echo "<td>".$row["phone_no"]."</td>";
                     echo "<br>Email: ";
                     echo "<td>".$row["owner_email"]."</td>";
                     echo "<br>Address: ";
                     echo "<td>".$row["street_number"]." ".$row["street"].","."</td>";
                     echo "<br>         ".$row["city"].", ".$row["state"]." ".$row["zip_code"]."</td>";
                     echo "<br><br><br>"; 
          }
      }
     ?> 
        </header>
            </article>
          </div>
          <div class="4u 12u(narrower)">
            <!-- Sidebar -->
            <section id="sidebar">
              <section>
                <header>
                  <h3>Business Comments</h3>
                </header>
                  <?
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

                    $bizName = $_GET["name"];
                    $bizName = addslashes($bizName);

                    $sql = "SELECT business_number
                            FROM BusinessProfile
                            WHERE business_name = '$bizName'";
                    if($result = $conn->query($sql)){
                      $row = $result->fetch_assoc();
                      $bizNum = $row['business_number'];
                    }

                    $sql2 = "SELECT comment_number
                            FROM businessCommented
                            WHERE business_number = '$bizNum'";
                   if($result = $conn->query($sql2)){
                      $row = $result->fetch_assoc();
                      $comNum = $row['comment_number'];
                    }

                    $sql3 = "SELECT number_of_stars, comment_txt
                            FROM Comments
                            WHERE comment_number = '$comNum'";
                    if($result = $conn->query($sql3)){
                      $row = $result->fetch_assoc();
                      echo "Rating: ".$row['number_of_stars'];
                      echo "<br>Comment: ".$row['comment_txt'];
                    }    

                    /*$sql = "SELECT business_number 
                            FROM BusinessProfile
                            WHERE business_name = '$bizName'";

                    if($result = $conn->query($sql)){
                       $row = $result->fetch_assoc();
                       $bizNum = $row['business_number'];
                    }

                    $sql2 = "SELECT comment_number
                            FROM businessCommented
                            WHERE business_number = '$bizNum'";

                    if($result2 = $conn->query($sql2)){
                        $row = $result2->fetch_assoc();
                        $comNum = $row['comment_number'];
                    }*/
                    $sql4 = "SELECT rating_id
                              FROM BusinessRated
                              WHERE business_number = '$bizNum'";
                    if($result4 = $conn->query($sql4)){
                        while($row = $result4->fetch_assoc()){
                            $ratingid = $row['rating_id'];
                        }     
                    }     
                                  
                    $sql5 = "SELECT avg(T.number_of_stars) as ourAverage
                            FROM
                            (
                            SELECT number_of_stars
                            FROM Comments
                            WHERE comment_number = '$comNum'
                            UNION ALL
                            SELECT number_of_stars
                            FROM rating
                            WHERE rating_id = '$ratingid') as T
                            ORDER BY number_of_stars";
                    $result5 = $conn->query($sql5);
                    if($result5->num_rows > 0){
                        while ($row = $result5->fetch_assoc()) {
                          echo "<br>Average rating: ".$row['ourAverage'].".";
                        }
                    }
                    $conn->close();
                  ?>   


                   <header>
                    <br><br>
                  <h3>Social Atmosphere</h3>
                </header>
                  <?
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

                    $bizName = $_GET["name"];
                    $bizName = addslashes($bizName);

                    $sql = "SELECT business_number
                            FROM BusinessProfile
                            WHERE business_name = '$bizName'";
                    if($result = $conn->query($sql)){
                      $row = $result->fetch_assoc();
                      $bizNum = $row['business_number'];
                    }

                    $sql2 = "SELECT atmosphere_id
                            FROM AtmosphereGetter
                            WHERE business_number = '$bizNum'";
                   if($result = $conn->query($sql2)){
                      $row = $result->fetch_assoc();
                      $atNum = $row['atmosphere_id'];
                    }

                    $sql3 = "SELECT noise_level, group_friendly, family_friendly
                            FROM SocialAtmosphere
                            WHERE atmosphere_id= '$atNum'";
                    if($result = $conn->query($sql3)){
                      $row = $result->fetch_assoc();
                      echo "Noise level: ".$row['noise_level'];
                      echo "<br>Group friendly? ".$row['group_friendly'];
                      echo "<br>Famly friendly? ".$row['family_friendly'];
                    }    
                    $conn->close();
                  ?>   
          
              </section>
            </section>
          </div>
        </div>
      </div>
    </div>
    <div id="header-wrapper">
        <section id="hero" class="container">
        <a href="Endorse.html" class="button">Endorse</a></section>
      </div>
           
    <div id="promo-wrapper">
      
      <section id="promo">
        <form method="post" action="#">
          <h3>Social Atmosphere<br></h3>
          <h5>(Account Needed)</h5>
          <input name="noise_level" placeholder="Noise Level (1-5)" type="text"><br>
          <input name="group_friendly" placeholder="Group Friendly (yes or no)" type="text"><br>
          <input name="family_friendly" placeholder="Family Friendly (yes or no)" type="text"><br>
          <input name="customerEmail" placeholder="Customer Email" type="text"><br>
          
          
        <ul class="actions">
          <li><input value="Submit Atmosphere " type="submit" name="AtSubmit"> </li>
        
       
        </ul>
          </form>
          <?php
                    $servername = "localhost";
                    $username = "ashriver";
                    $password = "secret15";
                    $dbname = "ashriver";
                    //$email= $_GET["customerEmail"];
                    $vendor= $_GET["name"];
                    $vendor = addslashes($vendor);

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 


                    
                      
                    if(isset($_POST['AtSubmit'])) 
                    {

                    
                      // Enter the Code you want to execute after the form has been submitted
                      $noiseLevel = $_POST['noise_level'];
                      $groupFriendly = $_POST['group_friendly'];
                      $familyFriendly = $_POST['family_friendly'];
                      $email = $_POST['customerEmail'];
                      $randomNum = RAND();

                      $sql1 = "INSERT INTO SocialAtmosphere VALUES ('$randomNum', '$noiseLevel', '$groupFriendly', '$familyFriendly')";
                      if($result1 = $conn->query($sql1)){
                        $sql2 = "INSERT INTO AtmosphereGiver VALUES ('$email', '$randomNum')";
                        $result2 = $conn->query($sql2);

                        $sql3 = "SELECT business_number FROM BusinessProfile
                        WHERE business_name = '$vendor'";
                        $result3 = $conn->query($sql3);
                        $row = $result3->fetch_assoc();
                        $bizNum = $row['business_number'];
                        $sql4 = "INSERT INTO AtmosphereGetter VALUES ('$randomNum', '$bizNum')";
                        $result4 = $conn->query($sql4);

                        

                        echo "Submission has been received.";
                      }else{
                        echo "Submission did not go through. Please try again.";
                      }

                    
                    }

                    
                    $conn->close();
              ?>


        </section>
        <section id="promo">
        <form method="post" action="#">
          <br><br><br><h3>Rate Business<br></h3>
          <h5>(No Account Needed)<br></h5>
          <input name="rating" placeholder="Rating (1-5)" type="text"> <br>
          <ul class="actions">
            <li><input value="Rate" type="submit" name="rateSubmit"> </li><br><br><br>
          </ul>
        </form>

        <?php
                    $servername = "localhost";
                    $username = "ashriver";
                    $password = "secret15";
                    $dbname = "ashriver";
                    $email= $_GET["email"];
                    $vendor= $_GET["name"];
                    $vendor = addslashes($vendor);

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 


                   

                      
                    if(isset($_POST['rateSubmit'])) 
                    {

                    
                      // Enter the Code you want to execute after the form has been submitted
                      $rating = $_POST['rating'];
                      $randomNum = RAND();

                      $sql1 = "INSERT INTO rating VALUES ('$randomNum', CURDATE(), '$rating')";
                      if($result1 = $conn->query($sql1)){
                
                        $sql3 = "SELECT business_number FROM BusinessProfile
                        WHERE business_name = '$vendor'";
                        $result3 = $conn->query($sql3);
                        $row = $result3->fetch_assoc();
                        $bizNum = $row['business_number'];
                        $sql4 = "INSERT INTO BusinessRated VALUES ('$randomNum', '$bizNum')";
                        $result4 = $conn->query($sql4);

                        

                        echo "Submission has been received.";
                      }else{
                        echo "Submission did not go through. Please try again.";
                      }
                
                    }

                    
                    $conn->close();
              ?>

      
      </section>
      
    </div>
    <div id="footer-wrapper">
      <div id="footer" class="container">
        <header class="major">
          <h2>Leave Comment for Business<br>
          </h2>
          <h5>(Account Needed)</h5>
        </header>
        <div class="row">
          <section class="6u 12u(narrower)">
            <form method="post" action="#"> <input name="rating" placeholder="Rating (1-5)"
                type="text"><br>
                <input name="customerEmail" placeholder="Customer Email" type="text"><br>
              <div class="row 50%">
                <div class="12u"> <textarea name="comment" placeholder="Comment"></textarea>
                </div>
              </div>
              <div class="row 50%">
                <div class="12u">
                  <ul class="actions">
                    <li><input value="Leave Comment" type="submit" name="comSubmit"></li>
                    <li><input value="Clear form" type="reset"></li>
                  </ul>
                </div>
              </div>
            </form>

                    <?php
                    $servername = "localhost";
                    $username = "ashriver";
                    $password = "secret15";
                    $dbname = "ashriver";
                    //$email= $_GET["customerEmail"];
                    $vendor= $_GET["name"];
                    $vendor = addslashes($vendor);

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 


                   
                      
                    if(isset($_POST['comSubmit'])) 
                    {

                    
                      // Enter the Code you want to execute after the form has been submitted
                      $rating = $_POST['rating'];
                      $comment = $_POST['comment'];
                      $email = $_POST['customerEmail'];
                      $randomNum = RAND();

                      $sql1 = "INSERT INTO Comments VALUES ('$randomNum', '$comment', NOW(), '$rating')";
                      if($result1 = $conn->query($sql1)){
                       

                        $sql3 = "SELECT business_number FROM BusinessProfile
                        WHERE business_name = '$vendor'";
                        $result3 = $conn->query($sql3);
                        $row = $result3->fetch_assoc();
                        $bizNum = $row['business_number'];
                        $sql4 = "INSERT INTO businessCommented VALUES ('$bizNum', '$randomNum')";
                        $result4 = $conn->query($sql4);

                        $sql2 = "INSERT INTO customerCommented VALUES ('$email', '$randomNum')";
                        $result2 = $conn->query($sql2);

                        

                        echo "Submission has been received.";
                      }else{
                        echo "Submission did not go through. Please try again.";
                      }

                    }
                    
                    
                    $conn->close();
              ?>


          </section>
        </div>
      </div>
    </div>
    <!--Deals-->
    <div id="promo-wrapper">
      <section id="promo">
        
        <form method="post" action="#">
          <h2>Create New Deal</h2>
          <h4>(Must Be Owner of Business)</h4>
          <br>
          <br>
          <input name="monetaryValue" placeholder="Monetary Value" type="int"><br>
          <br>Expiration Date<br>
          <input name="ExpirationDate" placeholder="(YYYY-MM-DD HH:MM:SS)" type="datetime"><br>
          <br>
          <input name="ownerEmail" placeholder="Owner Email" type="text"><br>
          <br>
          <input name="ownerPassword" placeholder="Password" type="password"><br>
          <br>
          <ul class="actions">
            <li><input value="Submit Deal" type="submit" name="dealSubmit"> </li>
          </ul>
        </form>

        <?php
                    $servername = "localhost";
                    $username = "ashriver";
                    $password = "secret15";
                    $dbname = "ashriver";
                    $email= $_GET["email"];
                    $vendor= $_GET["name"];
                    $vendor = addslashes($vendor);

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 
  
                    if(isset($_POST['dealSubmit'])) 
                    {

                    
                      // Enter the Code you want to execute after the form has been submitted
                      $amount = $_POST['monetaryValue'];
                      $expiration = $_POST['ExpirationDate'];
                      $ownEmail = $_POST['ownerEmail'];
                      $ownPass = $_POST['ownerPassword'];
                      $randomNum = RAND();

                      $sql1 = "SELECT BusinessOwner.* FROM BusinessOwner, BusinessProfile
                      WHERE BusinessProfile.business_name = '$vendor'
                      AND BusinessProfile.owner_email = BusinessOwner.owner_email
                      AND BusinessOwner.owner_email = '$ownEmail'
                      AND BusinessOwner.password = '$ownPass'";

                      $result1 = $conn->query($sql1);

                      if($result1->num_rows > 0){
                       

                        $sql3 = "SELECT business_number FROM BusinessProfile
                        WHERE business_name = '$vendor'";
                        $result3 = $conn->query($sql3);
                        $row = $result3->fetch_assoc();
                        $bizNum = $row['business_number'];

                        $sql4 = "INSERT INTO Deals VALUES ('$randomNum', '$expiration', '$amount')";
                        $result4 = $conn->query($sql4);

                        $sql2 = "INSERT INTO DealOffering VALUES ('$bizNum', '$randomNum')";
                        $result2 = $conn->query($sql2);

                        

                        echo "Submission has been received.";
                      }else{
                        echo "Submission did not go through. Please try again.";
                      }

                    }
                    
                    $conn->close();
              ?>


      </section>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <section id="promo">
        <h2>Existing Deals </h2>
        <br>
                <?php
                    $servername = "localhost";
                    $username = "ashriver";
                    $password = "secret15";
                    $dbname = "ashriver";
                    $email= $_GET["email"];
                    $vendor= $_GET["name"];
                    $vendor = addslashes($vendor);

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 
  
                    $sql2 = "SELECT Deals.*
                            FROM Deals, DealOffering, BusinessProfile
                            WHERE Deals.deal_number = DealOffering.deal_number
                            AND DealOffering.business_number = BusinessProfile.business_number
                            AND BusinessProfile.business_name = '$vendor'
                            AND Deals.expiration_date > NOW()
                            ORDER BY Deals.expiration_date desc
                          ";

                    if($result = $conn->query($sql2))
                    {

                       while ($row = $result->fetch_assoc()) {
                          echo "Receive $ ";
                          echo "<td>".$row["monetary_value"]."</td>";
                          echo " If you bring in this coupon before ";
                          echo "<td>".$row["expiration_date"]."</td>";
                          echo "<br>";
                        }

                    }else{
                      echo "There are no deals being offered at this time.";
                    }
                    
                    $conn->close();
              ?>


      </section>
    </div>
  </body>
</html>

  </body>
</html>

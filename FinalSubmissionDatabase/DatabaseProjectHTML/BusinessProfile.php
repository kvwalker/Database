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
    <!-- Footer -->
    <div id="footer-wrapper">
      <div id="footer" class="container">
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
      </div>
    </div>
    <div id="promo-wrapper">
      
      <section id="promo">
        <form method="post" action="#">
          <h3>Social Atmosphere<br></h3>
          <h5>(Account Needed)</h5>
          <input name="noise_level" placeholder="Noise Level (1-5)" type="text"><br>
          <input name="group_friendly" placeholder="Group Friendly (yes or no)" type="text"><br>
          <input name="family_friendly" placeholder="Family Friendly (yes or no)" type="text"><br>
          
          
        <ul class="actions">
          <li><input value="Submit Atmosphere " type="submit" name="AtSubmit"> </li>
        
       
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


                    if($_GET["email"]){
                      
                    if(isset($_POST['AtSubmit'])) 
                    {

                    
                      // Enter the Code you want to execute after the form has been submitted
                      $noiseLevel = $_POST['noise_level'];
                      $groupFriendly = $_POST['group_friendly'];
                      $familyFriendly = $_POST['family_friendly'];
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

                      /*if($result1->num_rows > 0){
                        $sql = "INSERT INTO followers (follower, followed) values ('$email', '$followEmail')";
                        if($result = $conn->query($sql)){
                        header('refresh:3, url=FollowUser.php?email='.$email);
                        echo "Your request has been submitted. Please check on the next page to ensure you have followed the correct email.";
                        }else{
                        echo "You are already following that email. Please try again.";
                        }
                      }else{
                        echo "This email doesn't exist. Please try again.";
                      }*/
                    }
                    }
                    
                    
                    $conn->close();
              ?>


        </section>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <section id="promo">
        <form method="post" action="#">
          <br><br><br><h3>Rate Business<br></h3>
          <h5>(No Account Needed)<br></h5>
          <input name="rating" placeholder="Rating (1-5)" type="text"> <br>
          <ul class="actions">
            
            <li><input value="Rate" type="submit"> </li><br><br><br>
          </ul>
        </form>
      
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
              <div class="row 50%">
                <div class="12u"> <textarea name="comment" placeholder="Comment"></textarea>
                </div>
              </div>
              <div class="row 50%">
                <div class="12u">
                  <ul class="actions">
                    <li><input value="Leave Comment" type="submit"></li>
                    <li><input value="Clear form" type="reset"></li>
                  </ul>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

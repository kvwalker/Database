<!DOCTYPE html>
<!--
	Telephasic by HTML5 UP	html5up.net | @n33co	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)-->
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Eat Here: Blacklist</title>
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
    <!-- Promo -->
    <div id="promo-wrapper">
      <section id="promo">
        <form method="post" action="">
          <h2>Blacklist User </h2>
          <br>
          <input name="emailblack" placeholder="Email" type="text"> <br>
          <input value="Blacklist" type="submit" name="submit"><br>
        </form>

        <?php
                    
                    if(isset($_POST['submit'])) 
                    {

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
                      // Enter the Code you want to execute after the form has been submitted
                      $userBlacklisted = $_POST['emailblack'];

                      $sql = "INSERT INTO blackList VALUES ('$userBlacklisted', '$email')";

                      if($result = $conn->query($sql)){
                        header('refresh:3, url=CustomerProfile.php?email='.$email);
                        echo "The user has been blacklisted. They will not be able to log in.";
                      }else{
                        echo "This email does not exist or you have already blocked it. Please try again.";
                      }
                      // Dispaly Success or failure Message if any 
                    }
                    else               
                    {
                      echo"Enter email above.";
                      // Display the Form and the Submit Button
                    }

                    
                    


                    $conn->close();
              ?>
        </section>
     
    </div>
  </body>
</html>

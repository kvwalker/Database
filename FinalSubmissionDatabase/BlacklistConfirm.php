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
                    $userBlacklisted = $_POST['emailblack'];

                    $sql = "INSERT INTO blackList (blocked_email, reporter_email) VALUES ('$userBlacklisted', '$email')";

                    if($result = $conn->query($sql)){
                      header('refresh:3, url=CustomerProfile.php?='.$email);
                      echo "The user has been blacklisted.";
                    }


                    $conn->close();
              ?>

        </section>
     
    </div>
  </body>
</html>

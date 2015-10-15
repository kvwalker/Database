<!DOCTYPE html>
<!--
	Telephasic by HTML5 UP	html5up.net | @n33co	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)-->
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>New Business</title>
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
  <body class="homepage">
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
      <!-- Hero -->
    <!-- Features 1 -->
    <div id="promo-wrapper">
      <section id="promo">
        <?php
                    $phone_no = $_POST['phoneno'];
                    $cuisine_type = $_POST['cuisine_type'];
                    $owner_email = $_POST['owner_email'];
                    $street_number = $_POST['street_number'];
                    $street = $_POST['street'];
                    $city = $_POST['city'];
                    $state = $_POST['state'];
                    $zip_code = $_POST['zip_code'];
                    $business_name = $_POST['business_name'];

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

                    $business_number = rand();
                    $sql = "INSERT INTO BusinessProfile VALUES ('$business_number', '$phone_no', '$cuisine_type', '$owner_email', '$street_number', 
                      '$street', '$city', '$state', '$zip_code', '$business_name')";

                    if($result = $conn->query($sql)){
                      header('refresh:2, url=index.html');
                      echo "Success! Please login on the homepage.";
                    }
                    else {
                      $checkstr = $conn->error;
                      header('refresh:2, url=index.html');
                      if(strpos($checkstr, "FOREIGN") != false) {
                        printf("You must be registered as a business owner to register a business.");
                      }
                    }

                    $conn->close();

                ?>
      </section>
    </div>
  </body>
</html>

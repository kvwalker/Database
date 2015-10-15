<!DOCTYPE html>
<!--
	Telephasic by HTML5 UP	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)-->
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
            <li class="break"> Welcome, <?php
                echo htmlspecialchars($_GET["email"]);
              ?>!
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- Footer -->
    <div id="footer-wrapper">
      <div id="footer" class="container">
        <header class="major">
          <h2 style="text-align: left;">Business Name(s): </h2>
          <br>
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

                		$email= $_GET["email"];

                    $sql = "SELECT * FROM BusinessProfile WHERE owner_email = '$email'";

                		if($result = $conn->query($sql))
                		{

                			while ($row = $result->fetch_assoc()) {
                         $name = $row["business_name"];
                         echo("<a href=\"BusinessProfile.php?name=".$name."\">".$name."</a>");
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
               <!--- <br>
              </span></div>
            <span style="font-style: italic;"></span><br>
            <span style="font-style: italic;"></span></div>-->
        </header>
      </div>
    </div>
  </body>
</html>

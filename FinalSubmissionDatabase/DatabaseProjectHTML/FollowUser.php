<!DOCTYPE html>
<!--
	Telephasic by HTML5 UP	html5up.net | @n33co	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)-->
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Eat Here: Follow User </title>
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
  <body class="homepage"> <!-- Header -->
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
      <!-- Features 2 -->
      <div class="wrapper">
        <h3>Emails You Are Following</h3>
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

                    $sql2 = "SELECT DISTINCT followed
                            FROM followers
                            WHERE follower = '$email'
                            ORDER BY followed asc
                          ";
                    $result = $conn->query($sql2);
                    if($result->num_rows > 0)
                    {

                       while ($row = $result->fetch_assoc()) {
                          echo "<td>".$row["followed"]."</td>";
                          echo "<br>";
                        }

                    }else{
                      echo "You are not following anyone. <br>";
                    }

                    
                     $conn->close();

          ?>


      </div>
      <!-- Hero -->
      <section id="hero" class="container">
        <h3>Emails Following You</h3>
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

                    $sql2 = "SELECT DISTINCT follower
                            FROM followers
                            WHERE followed = '$email'
                            ORDER BY follower asc
                          ";
                    $result = $conn->query($sql2);
                    if($result->num_rows > 0)
                    {

                       while ($row = $result->fetch_assoc()) {
                          echo "<td>".$row["follower"]."</td>";
                          echo "<br>";
                        }

                    }else{
                      echo "No one is following you. <br>";
                    }

                    
                     $conn->close();

          ?>
      </section>
      <!-- Features 2 -->
      <div class="wrapper">
        <h3>People You Can Follow</h3>
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

                    $sql2 = "SELECT customerprofile_email
                            FROM CustomerProfile
                            WHERE customerprofile_email != '$email'
                            AND customerprofile_email NOT IN
                            (
                            SELECT followed
                            FROM followers
                            WHERE follower = '$email'
                            )
                            Order By customerprofile_email asc
                          ";
                    $result = $conn->query($sql2);
                    if($result->num_rows > 0)
                    {

                       while ($row = $result->fetch_assoc()) {
                          echo "<td>".$row["customerprofile_email"]."</td>";
                          echo "<br>";
                        }

                    }else{
                      echo "There is no one you can follow. <br>";
                    }

                    
                     $conn->close();

          ?>
      </div>
      <!-- Hero -->
    </div>
  </body>
</html>

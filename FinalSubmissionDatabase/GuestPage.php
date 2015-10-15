<!DOCTYPE html>
<!--
  Telephasic by HTML5 UP  html5up.net | @n33co
  Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)-->
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Guest Page </title>
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
      <section id="hero" class="container">
        <p> </p>
        <div style="text-align: left;"> 
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

            $zipcode= $_POST["zipcode"];

            $sql = "SELECT * FROM BusinessProfile WHERE zip_code = '$zipcode'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc()) {
                  $name = $row["business_name"];
                  echo "Restaurant Name: ";
                  echo("<a href=\"BusinessProfile.php?name=".$name."\">".$name."</a>");
                  echo "<br>Cuisine Type: ";
                  echo "<td>".$row["cuisine_type"]."</td>";
                  echo "<br>";
                  echo "<br>";
                }
            }
            else {
              echo "There are no restaurants in your area yet!";
            }

            $conn->close();
      ?>

        </div>
        <p> </p>
      </section>
     

    <!-- Features 2 
    <div class="wrapper">
      <section class="container"> Restaurant Name:<br>
        Cuisine Type: </section>
    </div>

           Hero 
      <section id="hero" class="container">
        <p> </p>
        <div style="text-align: left;"> Restaurant Name:</div>
        <div style="text-align: left;"> Cuisine Type: </div>
        <p></p>
      </section> -->
    </div>
  </body>
</html> 
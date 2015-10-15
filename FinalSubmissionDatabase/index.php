<!DOCTYPE html>
<!--
  Telephasic by HTML5 UP  html5up.net | @n33co  Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)-->
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Index</title>
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
        <nav id="nav">
          <ul>
            <li> <a href="">Dropdown</a> </li>
            <li><a href="left-sidebar.html">Left Sidebar</a></li>
            <li class="break"><a href="right-sidebar.html">Right Sidebar</a></li>
            <li><a href="no-sidebar.html">No Sidebar</a></li>
          </ul>
        </nav>
      </div>
      <!-- Hero -->
      <section id="hero" class="container">
        <header>
          <h2>A Restaurant Guide </h2>
        </header>
        <br>
        Find restaurants near you. <br>
        Leave reviews for your favorite restaurant. <br>
        Find deals near you. <br>
        Manage your own Restaurants profile including offering deals or
        promotions.<br>
        <br>
    </div>
    <!-- Promo -->
    <div id="promo-wrapper">
      <section id="promo">
        <table border="0" cellpadding="0" cellspacing="10" width="100%">
          <tbody>
            <tr>
              <td valign="top" width="50%">
                <div class="row 50%">
<?php
$email = $_POST['email'];
$pass = $_POST['pass'];


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

#echo 'Name is: ' . $first_name . '<br />';

$sql = "SELECT * FROM CustomerProfile WHERE customerprofile_email = '$email' AND password = '$pass' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    //while($row = $result->fetch_assoc()) {
    //    echo "id: " . $row["first_name"]. " - Name: " . $row["last_name"]. " " . $row["how_long"]. "<br>";
    //}
    echo "entered login!";
  
    header('Location: CustomerProfile.php?email='.$email);

} else {
    header('refresh:2, url=index.html');
    echo "<br>Incorrect username or password. Please try again.";
}

$conn->close();

?>
           
          </tbody>
        </table>
      </section>
    </div>
  </body>
</html>


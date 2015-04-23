<?php
$host="127.0.0.1";
$port=3306;
$socket="";
$user="ashriver";
$password="";
$dbname="ashriver";

//create connection
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

// sql to create table
$sql = "CREATE TABLE `AtmosphereGetter` (
  `atmosphere_id` int(11) NOT NULL,
  `business_number` int(11) NOT NULL,
  PRIMARY KEY (`atmosphere_id`,`business_number`),
  KEY `business_numberA_idx` (`business_number`),
  CONSTRAINT `business_numberA` FOREIGN KEY (`business_number`) REFERENCES `BusinessProfile` (`business_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `atmosphere_idA` FOREIGN KEY (`atmosphere_id`) REFERENCES `SocialAtmosphere` (`atmosphere_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1";


if ($con->query($sql) === TRUE) {
	echo "Table AtmosphereGetter created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

$con->close();
?>

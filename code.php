<?php
//set up
$host="127.0.0.1";
$port=3306;
$socket="";
$user="ashriver";
$password="";
$dbname="ashriver";

//create connection
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());
//////Create Tables///////
// sql to create atmospheregetter
$atmget = "CREATE TABLE `AtmosphereGetter` (
  `atmosphere_id` int(11) NOT NULL,
  `business_number` int(11) NOT NULL,
  PRIMARY KEY (`atmosphere_id`,`business_number`),
  KEY `business_numberA_idx` (`business_number`),
  CONSTRAINT `business_numberA` FOREIGN KEY (`business_number`) REFERENCES `BusinessProfile` (`business_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `atmosphere_idA` FOREIGN KEY (`atmosphere_id`) REFERENCES `SocialAtmosphere` (`atmosphere_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

//check connection
if ($con->query($atmget) === TRUE) {
	echo "Table AtmosphereGetter created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create atmospheregiver
$atmgiv = "CREATE TABLE `AtmosphereGiver` (
  `assigner_email` varchar(45) NOT NULL,
  `atmosphere_id` int(11) NOT NULL,
  PRIMARY KEY (`assigner_email`,`atmosphere_id`),
  KEY `atmosphere_idB_idx` (`atmosphere_id`),
  CONSTRAINT `assigner_emailA` FOREIGN KEY (`assigner_email`) REFERENCES `CustomerProfile` (`customerprofile_email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `atmosphere_idB` FOREIGN KEY (`atmosphere_id`) REFERENCES `SocialAtmosphere` (`atmosphere_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($atmgiv) === TRUE) {
	echo "Table AtmosphereGiver created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create blacklist
$blklist = "CREATE TABLE `blackList` (
  `blocked_email` varchar(45) NOT NULL,
  `reporter_email` varchar(45) NOT NULL,
  PRIMARY KEY (`blocked_email`,`reporter_email`),
  KEY `reporter_emailA_idx` (`reporter_email`),
  CONSTRAINT `blocked_emailA` FOREIGN KEY (`blocked_email`) REFERENCES `CustomerProfile` (`customerprofile_email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reporter_emailA` FOREIGN KEY (`reporter_email`) REFERENCES `CustomerProfile` (`customerprofile_email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($blklist) === TRUE) {
	echo "Table blacklist created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create businessCommented
$bizcomm = "CREATE TABLE `businessCommented` (
  `business_number` int(11) NOT NULL,
  `comment_number` int(11) NOT NULL,
  PRIMARY KEY (`business_number`,`comment_number`),
  KEY `comment_numberZ_idx` (`comment_number`),
  CONSTRAINT `business_numberZ` FOREIGN KEY (`business_number`) REFERENCES `BusinessProfile` (`business_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_numberZ` FOREIGN KEY (`comment_number`) REFERENCES `Comments` (`comment_number`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($bizcomm) === TRUE) {
	echo "Table businessCommented successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create businessEndorser
$bizendor = "CREATE TABLE `businessEndorser` (
  `business_number` int(11) NOT NULL,
  `owner_email` varchar(45) NOT NULL,
  PRIMARY KEY (`business_number`,`owner_email`),
  KEY `owner_emailB_idx` (`owner_email`),
  CONSTRAINT `business_numberD` FOREIGN KEY (`business_number`) REFERENCES `BusinessProfile` (`business_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `owner_emailB` FOREIGN KEY (`owner_email`) REFERENCES `BusinessOwner` (`owner_email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($bizendor) === TRUE) {
	echo "Table businessEndorsers created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create BusinessOwner
$bizown = "CREATE TABLE `BusinessOwner` (
  `owner_email` varchar(45) NOT NULL,
  `date_created` datetime NOT NULL,
  `password` varchar(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_initial` varchar(2) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `location` varchar(45) NOT NULL,
  PRIMARY KEY (`owner_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($bizown) === TRUE) {
	echo "Table BusinessOwner created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create BusinessProfile
$bizprof = "CREATE TABLE `BusinessProfile` (
  `business_number` int(11) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `cuisine_type` varchar(45) NOT NULL,
  `owner_email` varchar(45) NOT NULL,
  `street_number` int(11) NOT NULL,
  `street` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `business_name` varchar(45) NOT NULL,
  PRIMARY KEY (`business_number`),
  KEY `owner_email_idx` (`owner_email`),
  CONSTRAINT `emailkey` FOREIGN KEY (`owner_email`) REFERENCES `BusinessOwner` (`owner_email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($bizprof) === TRUE) {
	echo "Table BusinessProfile created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create BusinessRated
$bizrate = "CREATE TABLE `BusinessRated` (
  `rating_id` int(11) NOT NULL,
  `business_number` int(11) NOT NULL,
  PRIMARY KEY (`rating_id`,`business_number`),
  KEY `business_number_idx` (`business_number`),
  CONSTRAINT `rating_idA` FOREIGN KEY (`rating_id`) REFERENCES `rating` (`rating_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `business_numberF` FOREIGN KEY (`business_number`) REFERENCES `BusinessProfile` (`business_number`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($bizprof) === TRUE) {
	echo "Table BusinessRated created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create Comments
$comm = "CREATE TABLE `Comments` (
  `comment_number` int(11) NOT NULL,
  `comment_txt` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL,
  `number_of_stars` int(11) NOT NULL,
  PRIMARY KEY (`comment_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($comm) === TRUE) {
	echo "Table Comments created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create customerCommented
$custcomm = "CREATE TABLE `customerCommented` (
  `customer_email` varchar(45) NOT NULL,
  `comment_number` int(11) NOT NULL,
  PRIMARY KEY (`customer_email`,`comment_number`),
  KEY `comment_numberZ_idx` (`comment_number`),
  CONSTRAINT `comment_number` FOREIGN KEY (`comment_number`) REFERENCES `Comments` (`comment_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `customer_email5` FOREIGN KEY (`customer_email`) REFERENCES `CustomerProfile` (`customerprofile_email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($custcomm) === TRUE) {
	echo "Table customerCommented created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create CustomerNoProfile
$custnoprof = "CREATE TABLE `CustomerNoProfile` (
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `noprofile_email` varchar(45) NOT NULL,
  PRIMARY KEY (`noprofile_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($custnoprof) === TRUE) {
	echo "Table CustomerNoProfile created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create CustomerProfile
$custprof = "CREATE TABLE `CustomerProfile` (
  `customerprofile_email` varchar(45) NOT NULL,
  `password` varchar(20) NOT NULL,
  `date_created` date DEFAULT NULL,
  `first_name` varchar(15) DEFAULT NULL,
  `middle_initial` varchar(2) DEFAULT NULL,
  `last-name` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`customerprofile_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($custprof) === TRUE) {
	echo "Table CustomerProfile created successfully";
} else {
	echo "Error creating table: " . $con->error;
}



$con->close();
?>

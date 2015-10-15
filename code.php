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

//create CustomerRating
$custrat = "CREATE TABLE `CustomerRating` (
  `rating_id` int(11) NOT NULL,
  `rater_email` varchar(45) NOT NULL,
  PRIMARY KEY (`rating_id`,`rater_email`),
  KEY `email_idx` (`rater_email`),
  CONSTRAINT `rating_idY` FOREIGN KEY (`rating_id`) REFERENCES `rating` (`rating_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rater_emailA` FOREIGN KEY (`rater_email`) REFERENCES `CustomerNoProfile` (`noprofile_email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($custrat) === TRUE) {
	echo "Table CustomerRating created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create CustomerReviewer
$custrev = "CREATE TABLE `CustomerReviewer` (
  `comment_number` int(11) NOT NULL,
  `customer_email` varchar(45) NOT NULL,
  PRIMARY KEY (`comment_number`,`customer_email`),
  KEY `customer_email9_idx` (`customer_email`),
  CONSTRAINT `comment_numberG` FOREIGN KEY (`comment_number`) REFERENCES `Comments` (`comment_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `customer_email9` FOREIGN KEY (`customer_email`) REFERENCES `CustomerProfile` (`customerprofile_email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($custrev) === TRUE) {
	echo "Table CustomerReviewer created successfully";
} else {
	echo "Error creating table: " . $con->error;
}


//create DealAccepting
$dealacc = "CREATE TABLE `DealAccepting` (
  `customer_email` varchar(45) NOT NULL,
  `deal_number` int(11) NOT NULL,
  PRIMARY KEY (`customer_email`,`deal_number`),
  KEY `deal_numberA_idx` (`deal_number`),
  CONSTRAINT `customer_email2` FOREIGN KEY (`customer_email`) REFERENCES `CustomerProfile` (`customerprofile_email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `deal_numberA` FOREIGN KEY (`deal_number`) REFERENCES `Deals` (`deal_number`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($dealacc) === TRUE) {
	echo "Table DealAccepting created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create DealOffering
$dealoff = "CREATE TABLE `DealOffering` (
  `business_number` int(11) NOT NULL,
  `deal_number` int(11) NOT NULL,
  PRIMARY KEY (`business_number`,`deal_number`),
  KEY `deal_numberB_idx` (`deal_number`),
  CONSTRAINT `business_number7` FOREIGN KEY (`business_number`) REFERENCES `BusinessProfile` (`business_number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `deal_numberB` FOREIGN KEY (`deal_number`) REFERENCES `Deals` (`deal_number`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($dealoff) === TRUE) {
	echo "Table DealOffering created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create Deals
$dealsql = "CREATE TABLE `Deals` (
  `deal_number` int(11) NOT NULL,
  `expiration_date` datetime NOT NULL,
  `monetary_value` int(11) NOT NULL,
  PRIMARY KEY (`deal_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($dealsql) === TRUE) {
	echo "Table Deals created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create friends
$friendsql = "CREATE TABLE `friends` (
  `friend1_email` varchar(45) NOT NULL,
  `friend2_email` varchar(45) NOT NULL,
  PRIMARY KEY (`friend1_email`,`friend2_email`),
  KEY `friend2_emailB_idx` (`friend2_email`),
  CONSTRAINT `friend1_emailA` FOREIGN KEY (`friend1_email`) REFERENCES `CustomerProfile` (`customerprofile_email`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `friend2_emailB` FOREIGN KEY (`friend2_email`) REFERENCES `CustomerProfile` (`customerprofile_email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($friendsql) === TRUE) {
	echo "Table friends created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create messages
$messagesql = "CREATE TABLE `messages` (
  `Message_number` int(11) NOT NULL,
  `message_sender_email` varchar(45) NOT NULL,
  `message_receiver_email` varchar(45) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `message_content` varchar(200) NOT NULL,
  PRIMARY KEY (`Message_number`),
  KEY `sender_emailA_idx` (`message_sender_email`),
  KEY `message_receiver_emailA_idx` (`message_receiver_email`),
  CONSTRAINT `message_sender_emailA` FOREIGN KEY (`message_sender_email`) REFERENCES `CustomerProfile` (`customerprofile_email`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `message_receiver_emailA` FOREIGN KEY (`message_receiver_email`) REFERENCES `CustomerProfile` (`customerprofile_email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($messagesql) === TRUE) {
	echo "Table messages created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create rating
$rat = "CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `number_of_stars` int(11) NOT NULL,
  PRIMARY KEY (`rating_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($rat) === TRUE) {
	echo "Table rating created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

//create SocialAtmosphere
$socatm = "CREATE TABLE `SocialAtmosphere` (
  `atmosphere_id` int(11) NOT NULL,
  `noise_level` int(11) NOT NULL,
  `group_friendly` varchar(4) DEFAULT NULL,
  `family_friendly` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`atmosphere_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

//check connection
if ($con->query($socatm) === TRUE) {
	echo "Table SocialAtmosphere created successfully";
} else {
	echo "Error creating table: " . $con->error;
}

$con->close();
?>

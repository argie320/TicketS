<?php 
 
include ("../../config.php");
						
$sql = "CREATE TABLE IF NOT EXISTS ticket (
			user varchar(25) NOT NULL,
  			source varchar(25) NOT NULL,
			status varchar(25) NOT NULL,
  			assignto varchar(25) NOT NULL,
  			subject varchar(25) NOT NULL,
  			issue varchar(255) NOT NULL,
  			details varchar(25) NOT NULL,
  			remarks varchar(255) NOT NULL,
  			department varchar(255) NOT NULL,
  			company varchar(25) NOT NULL,
  			duedate date NOT NULL,
  			priority varchar(25) NOT NULL,
  			ticketID int(10) NOT NULL
			);";
						
$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE) or trigger_error('Error'); 

$result = mysqli_query($dbc, $sql);


?>
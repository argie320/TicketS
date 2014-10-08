<?php

include('steadFast.class.php'); 

$sql = "CREATE TABLE IF NOT EXISTS sv_ticket_item_details (

item int(11) NOT NULL,
Unit_Brand varchar(20) NOT NULL,
Unit_Model varchar(20) NOT NULL,
Machine_Serial_No varchar(20) NOT NULL,
Part_No_Quantity  varchar(20) NOT NULL,
Quantity int(11) NOT NULL,
Warranty  varchar(20) NOT NULL,
sv_number int(11) NOT NULL,
log_id int(11) NOT NULL AUTO_INCREMENT,
PRIMARY KEY(log_id)

)";

$app = new steadFast();
$app->executeQuery($sql)

?>
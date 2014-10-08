<?php

include('steadFast.class.php'); 

$sql = "CREATE TABLE IF NOT EXISTS sv_ticket_header(
  sv_number int(11) NOT NULL,
  log_ID int(11) NOT NULL AUTO_INCREMENT,
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
  ticketID int(10) NOT NULL,
  response text,
  help_topic varchar(20) NOT NULL,
  slaplan varchar(16) NOT NULL,
  duetime date NOT NULL,
  PRIMARY KEY (log_ID)
)";

$app = new steadFast();
$app->executeQuery($sql)

?>
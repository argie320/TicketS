<?php

include "init.php";
$date =  date('Y-m-d');
	  
$result=DB::getInstance()->prepare("UPDATE sv_ticket_header SET isOverdue=1 WHERE date_created < ? AND sv_ticket_header.isClosed = 0");
$result->execute(array($date));

/////////////////////////////////////////////////


?>





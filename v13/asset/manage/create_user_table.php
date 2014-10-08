<?php 

include('steadFast.class.php'); 

$sql = "CREATE TABLE gagamit(
						registration_date DATETIME,
						user_name VARCHAR(255),
						pass_word VARCHAR(255),
						email VARCHAR(255),
						fullname VARCHAR(255),
						phone VARCHAR(255),
						mobile VARCHAR(255),
						position VARCHAR(255),
						company VARCHAR(255),
						ID int NOT NULL AUTO_INCREMENT,
						type INT,
						register INT,
						PRIMARY KEY (ID)
						);";

$app = new steadFast();
$app->executeQuery($sql)


?>
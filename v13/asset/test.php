<?php 

include('steadFast.class.php'); 

if(isset($_GET['val'])){
	
	$app = new steadFast();
	
	/*
	$check = $app->checkUsernameIfExits($_GET['val']);

	if($check != 0){
		echo  "Valid Username";
	}else{
		echo "Invalid Username";
	}
	*/
	
	$check = $app->checkEmailIfExits($_GET['val']);

	if($check != 0){
		echo  "Valid Email";
	}else{
		echo "Invalid Email";
	}
	
}



?>
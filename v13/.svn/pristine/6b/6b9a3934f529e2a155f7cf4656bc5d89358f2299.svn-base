<?php 

include ('asset/steadFast.class.php');

if(isset($_GET['un'])&&isset($_GET['ps'])){
	
	$un = $_GET['un'];
	$ps = $_GET['ps'];
	
	//echo "$un and $ps";
	
	
	//$app = new steadFast();
	
	$dbc = new mysqli("localhost", "root","admin", "steadfast");
	
	$sql = "SELECT user_name, pass_word, type FROM gagamit WHERE user_name = '".$un."'";
	
	//echo $sql;
	
	$result = mysqli_query($dbc, $sql);
	echo $loginSuccess = FALSE;
	if($result->num_rows){      
			
			// loop through all the fetched messages to build the result message
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				
				$mPassword = $row['pass_word'];
				
				if(hash("sha256", $ps)==$mPassword)
				
					echo $loginSuccess = TRUE;
					
				else
					echo $loginSuccess = FALSE;
			}
	}

	
}

?>
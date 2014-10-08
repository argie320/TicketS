<?php 

include "connection.php";

function escape_data ($data) {

 global $dbc;

 if (ini_get('magic_quotes_gpc')) {
 	$data = stripslashes($data);
 }
	
 return $data = mysqli_real_escape_string($dbc, trim($data));

}

if(isset($_POST['company'])){	


    $company = preg_replace('#[^a-zA-Z0-9 ]#i',  '' ,escape_data($_POST['company'])); 
	
	$sql = "SELECT * FROM tblcustomer WHERE company = '$company' LIMIT 1";
	
	$result = mysqli_query($dbc, $sql);
	

	$company_check = mysqli_num_rows($result);
	
	
	if($company_check > 0){
		    
			while($row = $result->fetch_assoc()){
				
			$addressToDeliver = $row['adddel'];
			$addressToBill = $row['addbill'];
			$Attention_1 = $row['att1'];
			$Attention_2 = $row['att2'];
			$Attention_3 = $row['att3'];
			$contactnum  = $row['contactnum'];
			$faxnum      = $row['faxnum'];
		
			$output =  array(
						 'addressToDeliver'=>$addressToDeliver,
                 		 'addressToBill'=>$addressToBill,
                         'Attention_1'=>$Attention_1,
						 'Attention_2'=>$Attention_2,
						 'Attention_3'=>$Attention_3,
						 'Contact_number'=>$contactnum,
						 'Fax_number'=>$faxnum
					);

			echo json_encode($output,JSON_FORCE_OBJECT);
		}
	}else{
		//echo 'No Record Found!';
	}
    
}




?>


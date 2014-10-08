<?php


class steadFast {
	
   // database handler
    private $mMysqli;  
    public $salt = "Zo4rU5Z1YyKJAASY0PT6EUg7BBYdlEhPaNLuxAwU8lqu1ElzHv0Ri7EM6irpx5w";
	
    // constructor opens database connection
    function __construct() 
    {   
    	// connect to the database
    	$this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,  
                                                      DB_DATABASE) or trigger_error('Error');      
        
            
    }
 
    // destructor closes database connection 
    public function __destruct()
    {
    	$this->mMysqli->close();
    }
	
    //any query 
    public function executeQuery($sql){
		$query = $sql;
		$result = $this->mMysqli->query($query);
		
    }
    
    public function paLogin($username, $password){
		
		$username = $this->mMysqli->real_escape_string(trim($username));
		$password = $this->mMysqli->real_escape_string(trim($password));
		
		$this->mMysqli->query('SELECT user_name, pass_word FROM gagamit WHERE '.$username.'');
		
     }
    
     public function createServiceTicket(
             $ticketStatus,$ticketResponse,$ticketTimeCreated,$FromUser,$CurrentUserEmail,
             $custcode,$CustomerName,$EmailAddress ,$ContactNumber,$FaxNo,$Address,$ContactPerson ,
             $source,$department, $HelpTopic,$priority,$SLAPlan,$duedate,$duetime, $assignto,$company, $Reference,
             $itemDetailsQuery,
             $subject, $issue, $details, $remarks,
			 $Queryinsert_sv_ticket_details_attachment
             ){
       
         $ticketStatus = $this->mMysqli->real_escape_string(trim($ticketStatus));
         $ticketResponse = $this->mMysqli->real_escape_string(trim($ticketResponse));
         $ticketTimeCreated = $this->mMysqli->real_escape_string(trim($ticketTimeCreated));
         $FromUser = $this->mMysqli->real_escape_string(trim($FromUser));
         $CurrentUserEmail = $this->mMysqli->real_escape_string(trim($CurrentUserEmail));
         $custcode = $this->mMysqli->real_escape_string(trim($custcode));
         $CustomerName = $this->mMysqli->real_escape_string(trim($CustomerName));
         $EmailAddress = $this->mMysqli->real_escape_string(trim($EmailAddress));
         $ContactNumber = $this->mMysqli->real_escape_string(trim($ContactNumber));
         $FaxNo = $this->mMysqli->real_escape_string(trim($FaxNo));
         $Address = $this->mMysqli->real_escape_string(trim($Address));
         $ContactPerson = $this->mMysqli->real_escape_string(trim($ContactPerson));
         $source = $this->mMysqli->real_escape_string(trim( $source ));
         $department= $this->mMysqli->real_escape_string(trim( $department ));
         $HelpTopic= $this->mMysqli->real_escape_string(trim( $HelpTopic ));
         $priority = $this->mMysqli->real_escape_string(trim( $priority ));
         $SLAPlan = $this->mMysqli->real_escape_string(trim( $SLAPlan ));
         $duedate = $this->mMysqli->real_escape_string(trim( $duedate ));
         $duetime = $this->mMysqli->real_escape_string(trim( $duetime ));
         $assignto = $this->mMysqli->real_escape_string(trim( $assignto ));
         $company = $this->mMysqli->real_escape_string(trim( $company ));
         $Reference = $this->mMysqli->real_escape_string(trim( $Reference ));
         
         
         $insert_to_tblcustomer = "INSERT INTO tbcustomer
		 (customer_snum,customer_company,customer_name,customer_email,customer_cnum,customer_fnum,customer_baddr,customer_contact,sv_number) 
          VALUES ('".$custcode."', '".$company."','".$CustomerName."','".$EmailAddress."','".$ContactNumber."','".$FaxNo."','".$Address."','".$ContactPerson."','".$custcode."');";
							   
         $insert_to_sv_ticket_header = "INSERT INTO  sv_ticket_header (date_created, time_created, sv_number  , ticketSender,  ticketSenderEmail , source , status, assignto,   department, company, reference, duedate, priority, ticketID, response, help_topic, slaplan, duetime ) 
                                        VALUES (CURDATE(), CURTIME() ,'".$custcode."','".$FromUser."','".$CurrentUserEmail."','".$source."','".$ticketStatus."','".$assignto."','".$department."','".$company."','".$Reference."', '".$duedate."','".$priority."','".$custcode."','".$ticketResponse."', '".$HelpTopic."','".$SLAPlan."', '".$duetime."');";
										
	      $insert_sv_ticket_details ="INSERT INTO sv_ticket_details( sv_number,subject ,  issue ,  remarks ) 
                                        VALUES ('".$custcode."','".$subject."','".$issue."','".$remarks."'); ";
				
         $insert_sv_ticket_details_attachment = $Queryinsert_sv_ticket_details_attachment;
		 
		$InsertToTicketStatus ="INSERT INTO ticket_status(ticketNo,isCreated,isOpen,dateCreated)
	                                     VALUES('".$custcode."',1,1,now())";
	
         
         /* set autocommit to off */
         $this->mMysqli->autocommit(FALSE);
         
         $error = array();
         
         // Insert some values 
         $a_move = $this->mMysqli->query($insert_to_tblcustomer);
                if($a_move == false ){array_push($error, " Error in first query"); }
         $b_move = $this->mMysqli->query($insert_to_sv_ticket_header);
                if($b_move == false ){array_push($error, " Error in second query"); }
				

         $c_move = $this->mMysqli->query($insert_sv_ticket_details);
                if($c_move == false ){array_push($error, " Error in third query"); }
         $d_move = $this->mMysqli->query($itemDetailsQuery );
                if($d_move == false ){array_push($error, " Error in forth query"); }
         $e_move = $this->mMysqli->query($insert_sv_ticket_details_attachment);
                if($e_move == false ){array_push($error, " Error in fith query"); }

         $f_move = $this->mMysqli->query($InsertToTicketStatus);
                if($f_move == false ){array_push($error, " Error in sixth query"); }
         
         if(!empty($error)){
               $this->mMysqli->rollback();
               return $this->mMysqli->error; 
         }
         
         // commit transaction 
         $this->mMysqli->commit();
         
       $this->sendTicketEmail($assignto, $subject, $custcode, $CurrentUserEmail);
        return $this->mMysqli->error; 
       
        
     
     }
	 
	public function GenerateServiceNumber(){
		//generate random num
		$service_num = rand(1,999999);
		
		$query = "SELECT sv_number FROM sv_ticket_header WHERE sv_number ";
		
		$result = $this->mMysqli->query($query);
		
		if($result->num_rows){
		
		 	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			
				//gernerate again if found is already exist
				$service_num = rand(1,999999);
			}
			
			$result->close();
		}
		
		return  $service_num;
		
	}

    public function GenerateWorkOrderNumber(){
        //generate random num
        $work_number = rand(1,999999);

        $query = "SELECT work_number FROM wo_ticket_details WHERE work_number ";

        $result = $this->mMysqli->query($query);

        if($result->num_rows){

            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

                //gernerate again if found is already exist
                $work_number = rand(1,999999);
            }

            $result->close();
        }

        return $work_number;

    }
	
	// validate user name (must be empty, and must not be already registered)
	public function checkUsernameIfExits($value){
		
		// trim and escape input value    
		$value = $this->mMysqli->real_escape_string(trim($value));
		
		// empty user name is not valid
		if ($value == null) 
			return '0'; // not valid
		
		// check if the username exists in the database
		$query = $this->mMysqli->query('SELECT user_name FROM gagamit WHERE user_name ="' . $value . '"');
		
		if ($this->mMysqli->affected_rows > 0)
      		return '0'; // not valid
    	else
      		return '1'; // valid
		
	}
	
	
	// validate user email (must be empty, and must not be already registered)
	public function checkEmailIfExits($value){
		
		// trim and escape input value    
		$value = $this->mMysqli->real_escape_string(trim($value));
		
		// empty user name is not valid
		if ($value == null) 
			return 0; // not valid
		
		// check if the username exists in the database
		$query = $this->mMysqli->query('SELECT email FROM gagamit WHERE email ="' . $value . '"');
		
		if ($this->mMysqli->affected_rows > 0)
      		return '0'; // not valid
    	else
      		return '1'; // valid
		
	}
	
	public function retrieveAllUser(){
		
		$query = "SELECT fullname, email FROM gagamit";
		
		$result = $this->mMysqli->query($query);
		
		//http://stackoverflow.com/questions/12272017/returning-multiple-rows-with-mysqli-and-arrays
		if($result->num_rows){
			
			 $rows = array();
    			
				while($row = $result->fetch_assoc()) {
					
					$fn = $row['fullname'];
					$em = $row['email'];
					
        			$rows[$fn] = $em;
    			}
    
			return $rows;
			
		}
		
	}

	
	
	
	
	//register
	public function register($uname, $password, $email, $fullname, $phone, $mobile, $position, $company, $type, $RegConfim){
		
		if($this->checkUsernameIfExits($uname) != 0){
			
			$uname = $this->mMysqli->real_escape_string($uname);
			$pass = $password = hash("sha256", $password);
			$email = $this->mMysqli->real_escape_string($email);
			$fullname = $this->mMysqli->real_escape_string($fullname);
			$phone = $this->mMysqli->real_escape_string($phone);
			$mobile = $this->mMysqli->real_escape_string($mobile);
			$position = $this->mMysqli->real_escape_string($position);
			$company = $this->mMysqli->real_escape_string($company);
			$type = $this->mMysqli->real_escape_string($company);
			$RegConfim = $this->mMysqli->real_escape_string($company);
		
			
			$sql = "INSERT INTO gagamit (registration_date, user_name, pass_word, email, fullname, phone, mobile, position, company, type, register)
				VALUES (NOW(), '".$uname."','".$pass."','".$email."','".$fullname."','".$phone."' ,'".$mobile."','".$position."' ,'".$company."' ,'".$type."' , 0 )";

			//echo $sql;
			$this->mMysqli->query($sql) or trigger_error('Failed to execute');



			// Create directory(folder) to hold each user's files(pics, MP3s, etc.)
		 //if (!file_exists("user/$uname")) {
		   //		mkdir("user/$uname", 0755);
	//		}

			if($this->mMysqli->affected_rows ==  1){

				$body = "Thanks for registering.<br />";
				$body .= "Your Username is: '".$uname."' and Your Password is: '".$password."'";

				mail($_POST['email'], 'Service Ticket','$body', 'From : auto-responder@jumpsolutions.ph');

				return TRUE;

			}else{
				return FALSE;
			}

		}





	}
	public function login($username, $password, $type){

		//echo $username;
		//echo $password;

		//return hash("sha256", $password)==$mPassword;

		$sql = "SELECT user_name, pass_word, position FROM gagamit WHERE user_name = ? ";

		$result = DB::getInstance()->prepare($sql);
        $result->execute(array($username));

		// check to see if we have any results
		if($result->rowCount()){
			// loop through all the fetched messages to build the result message
			while ($row = $result->fetch()) {
                $mPassword = $row['pass_word'];
                $position = $row['position'];


                //Check the password is match to hash
                if(hash("sha256", $password)==$mPassword){

                    //then ckeck to position
                    if($position==0)
                        //CSR
                        return 0;
                    else  if($position==1)
                        //Supervisor
                        return 1;
                    else  if($position==2)
                        //Engineer
                        return 2;
                    else  if($position==3)
                        //Engineer
                        return 3;

                }else{
                    //Password does not match
                    return -1;
                }

            }
		}else{
           return -1;
        }

	}
	
	
	public function getuseremail($username){
		$email = "";
		$username = $this->mMysqli->real_escape_string($username);
		
		$sql = "SELECT user_name, email  FROM gagamit WHERE user_name = '".$username."' ";
		
		
		$result = $this->mMysqli->query($sql);  
		
		// check to see if we have any results
		if($result->num_rows){      
			
			// loop through all the fetched messages to build the result message
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				
				$email = $row['email'];
				
				
				return $email;
					
			}
		}
	}
	
	public function sendTicketEmail($eto, $esubject, $ticketID, $from){
		
		$to      = $eto;
		$subject = $esubject;
                                            $ticketID = $ticketID;
		//begin of HTML message 
                                    
                                    $message ='<html> 
                                        <meta charset="UTF-8">
                                        <body> 
                                        Ticket Created.<br /> 
                                        <a href="http://steadfast.net76.net/steadfast/ticket.php?id='. $ticketID.'">http://steadfast.net76.net/steadfast/ticket.php?id='.$ticketID.'</a>
                                         </body>
                                         </html>';

                                    //end of message 
                                    $headers  = "From: $from\r\n"; 
                                    $headers .= "Content-type: text/html\r\n";
                                    //options to send to cc+bcc 
                                    ////$headers .= "Cc: [email]maa@p-i-s.cXom[/email]"; 
                                    // //$headers .= "Bcc: [email]email@maaking.cXom[/email]"; 
                                    
                                    // now lets send the email. 
                                    mail($to, $subject, $message, $headers); 
                                    
                                    //Redirect to ticket.php page
                                    header("Location: ticket.php?id=". $ticketID."");
                                    echo "Message has been sent....!"; 
		
		
		
		
	}

    public function getEmployee($type){
/*
        $database = new DB();
        $result = $database->dbhandler->query("SELECT fullname, email FROM gagamit WHERE position = '".$type."'");

        if($result->rowCount() > 0){

            $person = array();

            while($row = $result->fetchAll(PDO::FETCH_ASSOC)){
*/

        $result = $this->mMysqli->query("SELECT fullname, email FROM gagamit WHERE position ='".$type."' ");

        //http://stackoverflow.com/questions/12272017/returning-multiple-rows-with-mysqli-and-arrays
        if($result->num_rows){

            $person = array();

            while($row = $result->fetch_assoc()) {

                $fn = $row['fullname'];
                $em = $row['email'];

                $person[$fn] = $em;

            }

            return $person;
        }

    }
	
	
	public function emailThemAll(){
		
		// multiple recipients
		$to  = 'aidan@example.com' . ', '; // note the comma
		$to .= 'wez@example.com';
		
		// subject
		$subject = 'Birthday Reminders for August';
		
		// message
		$message = '
			<html>
				<head>
  					<title>Birthday Reminders for August</title>
				</head>
			<body>
				<p>Here are the birthdays upcoming in August!</p>
			<table>
				<tr>
					<th>Person</th><th>Day</th><th>Month</th><th>Year</th>
				</tr>
				<tr>
					<td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
				</tr>
				<tr>
      				<td>Sally</td><td>17th</td><td>August</td><td>1973</td>
				</tr>
			</table>
			</body>
		</html>
		';

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Additional headers
		$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
		$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
		$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
		$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
		
		// Mail it
		mail($to, $subject, $message, $headers);
	}
	
	public function recieveTicket(){
		
		
	}
	
}




?>
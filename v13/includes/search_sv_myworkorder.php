<?php

    $result =DB::getInstance()->prepare("SELECT DISTINCT * FROM sv_ticket_header
               INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
               INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			   INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			   INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
               WHERE gagamit.user_name = ?");
			   $result->execute(array($_SESSION['username']));
	
			   
	if(isset($_POST['searchbutton'])){
		
		          $txtSearch=$_POST['search'];
				  $uname = $_SESSION['username'];
				        switch($_POST['filterr']){
							case 'TicketNo':
                                    $result =DB::getInstance()->prepare("SELECT  * FROM sv_ticket_header
                                       INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                       INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			                           INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                       WHERE gagamit.user_name = ? AND sv_ticket_header.sv_number like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));  
							break;							
							case 'Subject':	 
							          $result =DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                       INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                       INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			                           INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                       WHERE gagamit.user_name = ? AND sv_ticket_details.subject like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));   							
							break;	 
							case 'SerialNo':	 
							          $result =DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                       INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                       INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
									   INNER JOIN sv_ticket_item_details ON sv_ticket_header.sv_number = sv_ticket_item_details.sv_number
			                           INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                       WHERE gagamit.user_name = ? AND sv_ticket_item_details.Part_No_Quantity like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));   							
							break;	
							 
					    }				  			
	}
			   
			   		   
					   
					   
					   	
if(isset($_GET['status'])){
		      $stat = $_GET['status'];
			 
		 switch($stat){
			 case 'open':
				  
				      
				      	 $result =DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                            INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                            INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                            WHERE ticket_status.isWOOpen=1 
							AND ticket_status.isWOClosed = 0
							AND gagamit.user_name = ?");
			             $result->execute(array($_SESSION['username']));

						 
	if(isset($_POST['searchbutton'])){
		
		       $txtSearch=$_POST['search'];
				  $uname = $_SESSION['username'];
				        switch($_POST['filterr']){
							case 'TicketNo':
                                    $result =DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                     INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                     INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                         INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			                         INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                     WHERE ticket_status.isWOOpen=1 
							         AND ticket_status.isWOClosed = 0
							         AND gagamit.user_name = ? AND sv_ticket_header.sv_number like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));  
							break;							
							case 'Subject':	 
                                    $result =DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                     INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                     INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                         INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			                         INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                     WHERE ticket_status.isWOOpen=1 
							         AND ticket_status.isWOClosed = 0
							         AND gagamit.user_name = ? AND sv_ticket_details.subject like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));   							
							break;	 
							case 'SerialNo':
							
                                    $result =DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                     INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                     INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                         INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
									 INNER JOIN sv_ticket_item_details ON sv_ticket_header.sv_number = sv_ticket_item_details.sv_number
			                         INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                     WHERE ticket_status.isWOOpen=1 
							         AND ticket_status.isWOClosed = 0
							         AND gagamit.user_name = ? AND sv_ticket_item_details.Part_No_Quantity like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));							
							 							
							break;	
							 
					       }				  			
	                 }

				  break;

				  case 'answered':
				  		 $result =DB::getInstance()->prepare("SELECT  * FROM sv_ticket_header
                            INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                            INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                            WHERE ticket_status.isWOOpen=1 AND ticket_status.isWOAnswered = 1
							AND ticket_status.isWOClosed = 0
							AND gagamit.user_name = ?");
			             $result->execute(array($_SESSION['username']));
				  
				  
	if(isset($_POST['searchbutton'])){
		
		       $txtSearch=$_POST['search'];
				  $uname = $_SESSION['username'];
				        switch($_POST['filterr']){
							case 'TicketNo':
				  		          $result =DB::getInstance()->prepare("SELECT  * FROM sv_ticket_header
                                  INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                  INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                      INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                  WHERE ticket_status.isWOOpen=1 AND ticket_status.isWOAnswered = 1
							      AND ticket_status.isWOClosed = 0
							      AND gagamit.user_name = ? AND sv_ticket_header.sv_number=?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));  
							break;							
							case 'Subject':	 
				  		          $result =DB::getInstance()->prepare("SELECT  * FROM sv_ticket_header
                                  INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                  INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                      INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                  WHERE ticket_status.isWOOpen=1 AND ticket_status.isWOAnswered = 1
							      AND ticket_status.isWOClosed = 0
							      AND gagamit.user_name = ? AND sv_ticket_details.subject=?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));    							
							break;	 
							case 'SerialNo':
							
				  		          $result =DB::getInstance()->prepare("SELECT  * FROM sv_ticket_header
                                  INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                  INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                      INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
								  INNER JOIN sv_ticket_item_details ON sv_ticket_header.sv_number = sv_ticket_item_details.sv_number
			                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                  WHERE ticket_status.isWOOpen=1 AND ticket_status.isWOAnswered = 1
							      AND ticket_status.isWOClosed = 0
							      AND gagamit.user_name = ?  AND sv_ticket_item_details.Part_No_Quantity like ?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%')); 							
													
							 							
							break;	
							 
					       }				  			
	                 }				  
				  
				  				  		  
				  
				  break;
			      
				  case 'overdue':
				  		 $result =DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                            INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                            INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                            WHERE ticket_status.isWOOpen=1 AND ticket_status.isWOOverdue = 1
							AND ticket_status.isWOClosed = 0
							AND gagamit.user_name = ?");
			             $result->execute(array($_SESSION['username']));
	
	if(isset($_POST['searchbutton'])){
		
		       $txtSearch=$_POST['search'];
				  $uname = $_SESSION['username'];
				        switch($_POST['filterr']){
							case 'TicketNo':
				  		          $result =DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                  INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                  INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                      INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                  WHERE ticket_status.isWOOpen=1 AND ticket_status.isWOOverdue = 1
							      AND ticket_status.isWOClosed = 0
							      AND gagamit.user_name = ? AND sv_ticket_header.sv_number=?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));  
							break;							
							case 'Subject':	 
				  		          $result =DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                  INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                  INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                      INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                  WHERE ticket_status.isWOOpen=1 AND ticket_status.isWOOverdue = 1
							      AND ticket_status.isWOClosed = 0
							      AND gagamit.user_name = ? AND sv_ticket_details.subject=?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));    							
							break;	 
							case 'SerialNo':

				  		          $result =DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                  INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                  INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                      INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
								  INNER JOIN sv_ticket_item_details ON sv_ticket_header.sv_number = sv_ticket_item_details.sv_number
			                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                  WHERE ticket_status.isWOOpen=1 AND ticket_status.isWOOverdue = 1
							      AND ticket_status.isWOClosed = 0
							      AND gagamit.user_name = ? AND sv_ticket_item_details.Part_No_Quantity like ?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%')); 							
	 							
							break;	
							 
					       }				  			
	                 }			
	
	
				  break;
		
				  
				  case 'closed':
				  		 $result =DB::getInstance()->prepare("SELECT  * FROM sv_ticket_header
                            INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                            INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                            WHERE ticket_status.isWOOpen=0 
							AND ticket_status.isWOClosed = 1
							AND gagamit.user_name = ?");
			             $result->execute(array($_SESSION['username']));
						 
	if(isset($_POST['searchbutton'])){
		
		       $txtSearch=$_POST['search'];
				  $uname = $_SESSION['username'];
				        switch($_POST['filterr']){
							case 'TicketNo':
				  		          $result =DB::getInstance()->prepare("SELECT  * FROM sv_ticket_header
                                  INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                  INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                      INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                  WHERE ticket_status.isWOOpen=0 
							      AND ticket_status.isWOClosed = 1
							      AND gagamit.user_name = ? AND sv_ticket_header.sv_number=?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));  
							break;							
							case 'Subject':	 
				  		          $result =DB::getInstance()->prepare("SELECT  * FROM sv_ticket_header
                                  INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                  INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                      INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
			                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                  WHERE ticket_status.isWOOpen=0 
							      AND ticket_status.isWOClosed = 1
							      AND gagamit.user_name = ? AND sv_ticket_details.subject=?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));    							
							break;	 
							case 'SerialNo':

				  		          $result =DB::getInstance()->prepare("SELECT  * FROM sv_ticket_header
                                  INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                  INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
			                      INNER JOIN ticket_status ON sv_ticket_header.log_ID=ticket_status.log_ID
								  INNER JOIN sv_ticket_item_details ON sv_ticket_header.sv_number = sv_ticket_item_details.sv_number
			                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                  WHERE ticket_status.isWOOpen=0 
							      AND ticket_status.isWOClosed = 1
							      AND gagamit.user_name = ? AND sv_ticket_item_details.Part_No_Quantity like ?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%')); 							
	 							
							break;	
							 
					       }				  			
	                 }									 
						 
						 
				  break;
				  
			     case 'pullout':
				           $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header 
				                       INNER JOIN tb_pullout ON sv_ticket_header.log_ID = tb_pullout.log
									   INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
                                       INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
									   INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID = wo_ticket_details.log_No
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID =ticket_status.log_ID  
									   WHERE gagamit.user_name =?
									   AND ticket_status.isWOClosed = 1 
									   OR ticket_status.isWOOpen = 1");
				          $result->execute(array($_SESSION['username']));


	if(isset($_POST['searchbutton'])){
		
		       $txtSearch=$_POST['search'];
				  $uname = $_SESSION['username'];
				        switch($_POST['filterr']){
							case 'TicketNo':
				                  $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header 
				                       INNER JOIN tb_pullout ON sv_ticket_header.log_ID = tb_pullout.log
									   INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
                                       INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
									   INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID = wo_ticket_details.log_No
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID =ticket_status.log_ID  
									   WHERE gagamit.user_name =?
									   AND ticket_status.isWOClosed = 1 
									   OR ticket_status.isWOOpen = 1 AND sv_ticket_header.sv_number=?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));  
							break;							
							case 'Subject':	 
				                  $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header 
				                       INNER JOIN tb_pullout ON sv_ticket_header.log_ID = tb_pullout.log
									   INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
                                       INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
									   INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID = wo_ticket_details.log_No
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID =ticket_status.log_ID  
									   WHERE gagamit.user_name =?
									   AND ticket_status.isWOClosed = 1 
									   OR ticket_status.isWOOpen = 1 AND sv_ticket_details.subject=?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));    							
							break;	 
							case 'SerialNo':


				                 $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header 
				                       INNER JOIN tb_pullout ON sv_ticket_header.log_ID = tb_pullout.log
									   INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
                                       INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
									   INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID = wo_ticket_details.log_No
									   INNER JOIN sv_ticket_item_details ON sv_ticket_header.sv_number = sv_ticket_item_details.sv_number
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID =ticket_status.log_ID  
									   WHERE gagamit.user_name =?
									   AND ticket_status.isWOClosed = 1 
									   OR ticket_status.isWOOpen = 1 AND sv_ticket_item_details.Part_No_Quantity like ?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%')); 							
	 							
							break;	
							 
					       }				  			
	                 }							  
						  
						  
				 break;
				 
			     case 'returned':
				          $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header 
				                       INNER JOIN tb_return ON sv_ticket_header.log_ID = tb_return.log
									   INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
                                       INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
									   INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID = wo_ticket_details.log_No
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID =ticket_status.log_ID  
									   WHERE gagamit.user_name =?
									   AND ticket_status.isWOClosed = 1 
									   OR ticket_status.isWOOpen = 1");
				          $result->execute(array($_SESSION['username']));

	if(isset($_POST['searchbutton'])){
		
		       $txtSearch=$_POST['search'];
				  $uname = $_SESSION['username'];
				        switch($_POST['filterr']){
							case 'TicketNo':
				                  $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header 
				                        INNER JOIN tb_return ON sv_ticket_header.log_ID = tb_return.log
									   INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
                                       INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
									   INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID = wo_ticket_details.log_No
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID =ticket_status.log_ID  
									   WHERE gagamit.user_name =?
									   AND ticket_status.isWOClosed = 1 
									   OR ticket_status.isWOOpen = 1 AND sv_ticket_header.sv_number=?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));  
							break;							
							case 'Subject':	 
				                  $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header 
				                       INNER JOIN tb_return ON sv_ticket_header.log_ID = tb_return.log
									   INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
                                       INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
									   INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID = wo_ticket_details.log_No
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID =ticket_status.log_ID  
									   WHERE gagamit.user_name =?
									   AND ticket_status.isWOClosed = 1 
									   OR ticket_status.isWOOpen = 1 AND sv_ticket_details.subject=?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));    							
							break;	 
							case 'SerialNo':

				                  $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header 
				                       INNER JOIN tb_return ON sv_ticket_header.log_ID = tb_return.log
									   INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
                                       INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
									   INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID = wo_ticket_details.log_No
									   INNER JOIN sv_ticket_item_details ON sv_ticket_header.sv_number = sv_ticket_item_details.sv_number
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID =ticket_status.log_ID  
									   WHERE gagamit.user_name =?
									   AND ticket_status.isWOClosed = 1 
									   OR ticket_status.isWOOpen = 1 AND sv_ticket_item_details.Part_No_Quantity like ?");

				                 $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header 
				                       INNER JOIN tb_return ON sv_ticket_header.log_ID = tb_return.log
									   INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
                                       INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
									   INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID = wo_ticket_details.log_No
									   INNER JOIN sv_ticket_item_details ON sv_ticket_header.sv_number = sv_ticket_item_details.sv_number
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID =ticket_status.log_ID  
									   WHERE gagamit.user_name =?
									   AND ticket_status.isWOClosed = 1 
									   OR ticket_status.isWOOpen = 1 AND sv_ticket_item_details.Part_No_Quantity like ?");
			                      $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%')); 							
	 							
							break;	
							 
					       }				  			
	                 }		


				 
			     break;
			
			
			 }
			
	
	}
	
					   
			   



    echo $loginSuccess = FALSE;
    if($result->rowCount()){

        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
				
				$ticketID = $row['sv_number'];
				$datecreated = $row['created'];
		     	$from = $row['ticketSender'];
				$assignto = $row['assignToEngineer'];
				$subject = $row['subject'];
				$priority = $row['priority'];
				$status = $row['status'];
                $fullname = $row['fullname'];
                $log = $row['log_ID'];

				/*Check the position of Username
					CSR 		= 0; can create/close ticket
					Supervisor 	= 1; can create work order
					Engineer 	= 2; can responde to work order.
									 create returnslip and pull-out */

		  		switch($stat){
					case 'pullout':
					 	$ticketURL = 'pulloutPDF.php?id=';
						break;
					case 'returned': 
						$ticketURL = 'returnslipPDF.php?id=';
						break;
					case 'open':
					    $ticketURL = 'closedWorkoder.php?id=';
					break;
					default:
						$ticketURL = "sv_workorder.php?id=";
						break;
				}

				$tabledata .= '
        		<tr>
                    	<th style="word-break:break-all; width:75px; height:25px;"><a href="'.$ticketURL.''.$ticketID.'&&log='.$log.'" style="color:#0099FF;">'.$ticketID.'</a></th>
                        <th style="word-break:break-all; width:75px; height:25px;">'.$datecreated.'</th>
                        <th style="word-break:break-all; width:260px; "height:25px;"><a href="'.$ticketURL.''.$ticketID.'&&log='.$log.'" style="color:#0099FF;">'.$subject.'</a></th>
                        <th style="word-break:break-all; width:150px; height:25px;">'.$from.'</th>
                        <th style="word-break:break-all; width:70px; height:25px;">'.$priority.'</th>
                        <th style="word-break:break-all; width:180px; height:25px;">'.$assignto.'</th>
                    </tr>
				';

			}
	}else{  }


?>
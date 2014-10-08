<?php

                $result = DB::getInstance()->prepare("SELECT DISTINCT * FROM sv_ticket_header
                        INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                        INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                        WHERE gagamit.user_name = ? ORDER BY sv_ticket_header.date_created DESC");
                $result->execute(array($usernamex));


	if(isset($_POST['searchbutton'])){
		
		          $txtSearch=$_POST['searchme'];
				  $uname = $_SESSION['username'];
				        switch($_POST['filterr']){
							case 'TicketNo':
                                      $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                      INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                      WHERE gagamit.user_name = ? AND sv_ticket_header.sv_number like ?");
			                          $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));  
							break;							
							case 'Subject':	 
                                      $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                      INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                      WHERE gagamit.user_name = ? AND sv_ticket_details.subject like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));   							
							break;	 
							case 'SerialNo':
							
                                      $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                      INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
									  INNER JOIN sv_ticket_item_details ON sv_ticket_header.sv_number = sv_ticket_item_details.sv_number
                                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                      WHERE gagamit.user_name = ? AND sv_ticket_item_details.Part_No_Quantity like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));   							
							break;	
							 
					    }				  			
	}
			   

if(isset($stat)){

     switch($stat){
		 
          case 'Open':
		  
		            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                     INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                     INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                     WHERE gagamit.user_name = ? AND sv_ticket_header.isClosed = 0
					 ORDER BY sv_ticket_header.date_created DESC");
                    $result->execute(array($usernamex));
					
	     if(isset($_POST['searchbutton'])){
		
		          $txtSearch=$_POST['searchme'];
				  $uname = $_SESSION['username'];
				        switch($_POST['filterr']){
							case 'TicketNo':
		                              $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                       INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                       INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                       WHERE gagamit.user_name = ? AND sv_ticket_header.isClosed = 0
					                   AND sv_ticket_header.sv_number like ?");
			                          $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));  
							break;							
							case 'Subject':	 
		                              $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                      INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                      WHERE gagamit.user_name = ? AND sv_ticket_header.isClosed = 0 
									  AND sv_ticket_details.subject like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));   							
							break;	 
							case 'SerialNo':

		                              $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                      INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
									  INNER JOIN sv_ticket_item_details ON sv_ticket_header.sv_number = sv_ticket_item_details.sv_number
                                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                      WHERE gagamit.user_name = ? AND sv_ticket_header.isClosed = 0
									  AND sv_ticket_item_details.Part_No_Quantity like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));   							
							break;	
							 
					    }				  			
	              }

					
		  
          break;
		  
          case 'Overdue':
                           $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                              INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                              INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                              WHERE gagamit.user_name = ? AND sv_ticket_header.isOverdue = 1
						      ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex));
					
	     if(isset($_POST['searchbutton'])){
		
		          $txtSearch=$_POST['searchme'];
				  $uname = $_SESSION['username'];
				        switch($_POST['filterr']){
							case 'TicketNo':
                                      $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                      INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                      WHERE gagamit.user_name = ? AND sv_ticket_header.isOverdue = 1
					                  AND sv_ticket_header.sv_number like ?");
			                          $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));  
							break;							
							case 'Subject':	 
                                      $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                      INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                      WHERE gagamit.user_name = ? AND sv_ticket_header.isOverdue = 1 
									  AND sv_ticket_details.subject like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));   							
							break;	 
							case 'SerialNo':

                                      $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                      INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
									  INNER JOIN sv_ticket_item_details ON sv_ticket_header.sv_number = sv_ticket_item_details.sv_number
                                      WHERE gagamit.user_name = ? AND sv_ticket_header.isOverdue = 1
                                      AND sv_ticket_item_details.Part_No_Quantity like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));   							
							break;	
							 
					    }				  			
	              }		      
		  
	      break;
	 
          case 'Answered':
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.isClosed = 0 
																AND sv_ticket_header.response = 1
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex));
					
	     if(isset($_POST['searchbutton'])){
		
		          $txtSearch=$_POST['searchme'];
				  $uname = $_SESSION['username'];
				        switch($_POST['filterr']){
							case 'TicketNo':
                                      $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                      INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                      WHERE gagamit.user_name = ? 
									  AND sv_ticket_header.isClosed = 0 
									  AND sv_ticket_header.response = 1
					                  AND sv_ticket_header.sv_number like ?");
			                          $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));  
							break;							
							case 'Subject':	 
                                      $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                      INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                      WHERE gagamit.user_name = ? 
									  AND sv_ticket_header.isClosed = 0 
									  AND sv_ticket_header.response = 1 
									  AND sv_ticket_details.subject like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));   							
							break;	 
							case 'SerialNo':

                                      $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                      INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
									  INNER JOIN sv_ticket_item_details ON sv_ticket_header.sv_number = sv_ticket_item_details.sv_number
                                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                      WHERE gagamit.user_name = ? 
									  AND sv_ticket_header.isClosed = 0 
									  AND sv_ticket_header.response = 1
                                      AND sv_ticket_item_details.Part_No_Quantity like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));   							
							break;	
							 
					    }				  			
	              }		      
		  
	      break;
		  
          case 'ClosedTicket':

                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                               INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                               INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                                               WHERE gagamit.user_name = ? AND sv_ticket_header.isClosed = 1
						                                       ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex));
					
	     if(isset($_POST['searchbutton'])){
		
		          $txtSearch=$_POST['searchme'];
				  $uname = $_SESSION['username'];
				        switch($_POST['filterr']){
							case 'TicketNo':
                                      $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                      INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                      WHERE gagamit.user_name = ? AND sv_ticket_header.isClosed = 1
					                  AND sv_ticket_header.sv_number like ?");
			                          $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));  
							break;							
							case 'Subject':	 
                                      $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                      INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
                                      WHERE gagamit.user_name = ? AND sv_ticket_header.isClosed = 1 
									  AND sv_ticket_details.subject like ?");
			                         $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));   							
							break;	 
							case 'SerialNo':

                                      $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                      INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                      INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=1
									  INNER JOIN sv_ticket_item_details ON sv_ticket_header.sv_number = sv_ticket_item_details.sv_number
                                      WHERE gagamit.user_name = ? AND sv_ticket_header.isClosed = 1
									  AND sv_ticket_item_details.Part_No_Quantity like ?");
									  $result->execute(array($_SESSION['username'],'%'.$txtSearch.'%'));
   							
							break;	
							 
					    }				  			
	              }		      
		  
	      break;

	 
	 
	 }

}
				
?>
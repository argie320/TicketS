
<?php

                    $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				              INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                              INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                              INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							  WHERE gagamit.user_name = ?
							  ORDER BY wo_ticket_details.wo_date_created DESC");
                    $result->execute(array($_SESSION['username']));
					


			        if(isset($_POST['searchbutton'])){		  
					            $searchx = $_POST['searchme'];
								
							switch($_POST['filterr']){
								 
					 case 'TicketNo':

					       $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				              INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                              INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                              INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							  WHERE gagamit.user_name = ? 
							  AND wo_ticket_details.sv_number like ?
							  AND gagamit.position = 2
							  ORDER BY wo_ticket_details.wo_date_created DESC");
                           $result->execute(array($_SESSION['username'],'%'.$searchx.'%'));	
	  
									  break;
					case 'Subject':

					       $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				              INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                              INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                              INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							  WHERE gagamit.user_name = ? 
							  AND sv_ticket_details.subject like ?
							  AND gagamit.position = 2
							  ORDER BY wo_ticket_details.wo_date_created DESC");
                           $result->execute(array($_SESSION['username'],'%'.$searchx.'%'));					 
	  
									  break;
					 default:
								   
                           $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				              INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                              INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                              INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							  WHERE gagamit.user_name = ?
							  AND gagamit.position = 2
							  ORDER BY wo_ticket_details.wo_date_created DESC");
                           $result->execute(array($_SESSION['username']));
								   	  
                                      break;
								                  }
					             }

                  





///////////////////////////////////// IF PULLOUT AND RETURNED IS PRESSED ////////////////////////////////////////////////////								  

if(isset( $_GET['status'])){		
         
		 $uname = $_SESSION['username'];
		  $stat = $_GET['status'];
		   
		switch($stat){
					
			case 'pullout':
			
				
				    $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				              INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                              INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
							  INNER JOIN tb_pullout ON wo_ticket_details.log_No = tb_pullout.log
                              INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							  WHERE gagamit.user_name = ? 
							  AND sv_ticket_header.isClosed = 0
							  AND gagamit.position = 2
							  ORDER BY wo_ticket_details.wo_date_created DESC");
                    $result->execute(array($_SESSION['username']));
										 
										 
			        if(isset($_POST['searchbutton'])){		  
					            $searchx = $_POST['searchme'];
								
							switch($_POST['filterr']){
								 
						     case 'TicketNo':
								   
				               $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				                  INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                                  INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
								  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
							      INNER JOIN tb_pullout ON wo_ticket_details.log_No = tb_pullout.log
                                  INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							      WHERE gagamit.user_name = ? 
								  AND sv_ticket_header.isClosed = 0
							      AND tb_pullout.sv_number like ?
							      AND gagamit.position = 2
								  ORDER BY wo_ticket_details.wo_date_created DESC");
                                $result->execute(array($_SESSION['username'],'%'.$searchx.'%'));								   

							 break;
						    case 'Subject':
							
				               $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				                  INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                                  INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
								  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
							      INNER JOIN tb_pullout ON wo_ticket_details.log_No = tb_pullout.log
                                  INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							      WHERE gagamit.user_name = ? 
								  AND sv_ticket_header.isClosed = 0
							      AND sv_ticket_details.subject like ?
							      AND gagamit.position = 2
								  ORDER BY wo_ticket_details.wo_date_created DESC");
                                $result->execute(array($_SESSION['username'],'%'.$searchx.'%'));
															
	  
							break;

								                  }
					             }

                      break;

	
			case 'returned':

				  
				    $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				              INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                              INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
							  INNER JOIN tb_return ON wo_ticket_details.log_No = tb_return.log
                              INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							  WHERE gagamit.user_name = ? 
							  AND sv_ticket_header.isClosed = 0
							  AND gagamit.position = 2
							  ORDER BY wo_ticket_details.wo_date_created DESC");
                    $result->execute(array($_SESSION['username']));




			        if(isset($_POST['searchbutton'])){		  
					            $searchx = $_POST['searchme'];
								
							switch($_POST['filterr']){
								 
							   case 'TicketNo':

				                  $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				                  INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                                  INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
								  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
							      INNER JOIN tb_return ON wo_ticket_details.log_No = tb_return.log
                                  INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							      WHERE gagamit.user_name = ? 
							      AND tb_return.sv_number like ?
								  AND sv_ticket_header.isClosed = 0
							      AND gagamit.position = 2
								  ORDER BY wo_ticket_details.wo_date_created DESC");
                                  $result->execute(array($_SESSION['username'],'%'.$searchx.'%'));								   

							  break;
							  case 'Subject':
							  
				                  $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				                  INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                                  INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
								  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
							      INNER JOIN tb_return ON wo_ticket_details.log_No = tb_return.log
                                  INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							      WHERE gagamit.user_name = ? 
								  AND sv_ticket_header.isClosed = 0
							      AND sv_ticket_details.subject like ?
							      AND gagamit.position = 2
								  ORDER BY wo_ticket_details.wo_date_created DESC");
                                  $result->execute(array($_SESSION['username'],'%'.$searchx.'%'));								      
							
	 						 break;

								                  }
					             }

                      break;

        case'Open':
		
                    $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				              INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                              INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                              INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							  WHERE gagamit.user_name = ? 
							  AND ticket_status.isWOClosed = 0
							  AND ticket_status.isWOOpen = 1
							  AND gagamit.position = 2
							  ORDER BY wo_ticket_details.wo_date_created DESC");
                    $result->execute(array($_SESSION['username']));	
					
					 
					  if(isset($_POST['searchbutton'])){		  
					            $searchx = $_POST['searchme'];
								
							switch($_POST['filterr']){
								 
							   case 'TicketNo':

				                  $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				                  INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                                  INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
								  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                                  INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							      WHERE gagamit.user_name = ?
								  AND wo_ticket_details.sv_number like ? 
							      AND ticket_status.isWOClosed = 0
							      AND ticket_status.isWOOpen = 1
							      AND gagamit.position = 2
								  ORDER BY wo_ticket_details.wo_date_created DESC");
                                  $result->execute(array($_SESSION['username'],'%'.$searchx.'%'));								   

							  break;
							  case 'Subject':
							  
				                  $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				                  INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                                  INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
								  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                                  INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							      WHERE gagamit.user_name = ? 
							      AND sv_ticket_details.subject like ?
							      AND ticket_status.isWOClosed = 0
							      AND ticket_status.isWOOpen = 1
							      AND gagamit.position = 2
								  ORDER BY wo_ticket_details.wo_date_created DESC");
                                  $result->execute(array($_SESSION['username'],'%'.$searchx.'%'));								      
							
	 						 break;

								                  }
					             }

               break;

					
	

        case'ClosedTicket':
		
		
                    $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				              INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                              INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                              INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							  WHERE gagamit.user_name = ? 
							  AND ticket_status.isWOClosed = 1
							  AND ticket_status.isWOOpen = 0
							  AND gagamit.position = 2
							  ORDER BY wo_ticket_details.wo_date_created DESC");
                    $result->execute(array($_SESSION['username']));	
		
		  if(isset($_POST['searchbutton'])){		  
					            $searchx = $_POST['searchme'];
								
							switch($_POST['filterr']){
								 
							   case 'TicketNo':

				                  $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				                  INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                                  INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
								  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                                  INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							      WHERE gagamit.user_name = ?
								  AND wo_ticket_details.sv_number like ? 
							      AND ticket_status.isWOClosed = 1
							      AND ticket_status.isWOOpen = 0							      
								  AND gagamit.position = 2
								  ORDER BY wo_ticket_details.wo_date_created DESC");
                                  $result->execute(array($_SESSION['username'],'%'.$searchx.'%'));								   

							  break;
							  case 'Subject':
							  
				                  $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				                  INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                                  INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
								  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                                  INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							      WHERE gagamit.user_name = ? 
							      AND sv_ticket_details.subject like ?
								  AND ticket_status.isWOClosed = 1
							      AND ticket_status.isWOOpen = 0
								  AND gagamit.position = 2
								  ORDER BY wo_ticket_details.wo_date_created DESC");
                                  $result->execute(array($_SESSION['username'],'%'.$searchx.'%'));								      
							
	 						 break;

								                  }
					             }

               break;

        case'Answered':
		
		
                    $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				              INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                              INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                              INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							  WHERE gagamit.user_name = ?
							  AND ticket_status.isWOClosed = 0
							  AND ticket_status.isWOOpen = 1 
							  AND ticket_status.isWOAnswered = 1
							  AND gagamit.position = 2
							  ORDER BY wo_ticket_details.wo_date_created DESC");
                    $result->execute(array($_SESSION['username']));	
		
		  if(isset($_POST['searchbutton'])){		  
					            $searchx = $_POST['searchme'];
								
							switch($_POST['filterr']){
								 
							   case 'TicketNo':

				                  $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				                  INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                                  INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
								  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                                  INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							      WHERE gagamit.user_name = ?
							      AND ticket_status.isWOClosed = 0
							      AND ticket_status.isWOOpen = 1 
							      AND ticket_status.isWOAnswered = 1
								  AND wo_ticket_details.sv_number like ? 
							      AND gagamit.position = 2
								  ORDER BY wo_ticket_details.wo_date_created DESC");
                                  $result->execute(array($_SESSION['username'],'%'.$searchx.'%'));								   

							  break;
							  case 'Subject':
							  
				                  $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				                  INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                                  INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
								  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                                  INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							      WHERE gagamit.user_name = ? 
							      AND ticket_status.isWOClosed = 0
							      AND ticket_status.isWOOpen = 1 
							      AND ticket_status.isWOAnswered = 1
							      AND sv_ticket_details.subject like ?
							      AND gagamit.position = 2
								  ORDER BY wo_ticket_details.wo_date_created DESC");
                                  $result->execute(array($_SESSION['username'],'%'.$searchx.'%'));								      
							
	 						 break;

								                  }
					             }

               break;					


        case'Overdue':
		
		
                    $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				              INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                              INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                              INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							  WHERE gagamit.user_name = ?
							  AND ticket_status.isWOClosed = 0
							  AND ticket_status.isWOOpen = 1 
							  AND sv_ticket_header.isOverdue = 1
							  AND gagamit.position = 2
							  ORDER BY wo_ticket_details.wo_date_created DESC");
                    $result->execute(array($_SESSION['username']));	
		
		  if(isset($_POST['searchbutton'])){		  
					            $searchx = $_POST['searchme'];
								
							switch($_POST['filterr']){
								 
							   case 'TicketNo':

				                  $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				                  INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                                  INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
								  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                                  INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							      WHERE gagamit.user_name = ?
							      AND ticket_status.isWOClosed = 0
							      AND ticket_status.isWOOpen = 1
								  AND wo_ticket_details.sv_number like ? 
							      AND sv_ticket_header.isOverdue = 1
							      AND gagamit.position = 2
								  ORDER BY wo_ticket_details.wo_date_created DESC");
                                  $result->execute(array($_SESSION['username'],'%'.$searchx.'%'));								   

							  break;
							  case 'Subject':
							  
				                  $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				                  INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                                  INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
								  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                                  INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							      WHERE gagamit.user_name = ? 
							      AND ticket_status.isWOClosed = 0
							      AND ticket_status.isWOOpen = 1
							      AND sv_ticket_details.subject like ?
								  AND sv_ticket_header.isOverdue = 1
							      AND gagamit.position = 2
								  ORDER BY wo_ticket_details.wo_date_created DESC");
                                  $result->execute(array($_SESSION['username'],'%'.$searchx.'%'));								      
							
	 						 break;

								                  }
					             }

               break;	
     


		default :
                    $result = DB::getInstance()->prepare("SELECT * FROM wo_ticket_details 
				              INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                              INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                              INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							  WHERE gagamit.user_name = ? 
							  AND ticket_status.isWOClosed = 0
							  AND ticket_status.isWOOpen = 1
							  AND gagamit.position = 2
							  ORDER BY wo_ticket_details.wo_date_created DESC");
                    $result->execute(array($_SESSION['username']));

	    break;
		
		}
		
	}
	


	
    echo $loginSuccess = FALSE;
    if($result->rowCount()){

        while ($row = $result->fetch(PDO::FETCH_ASSOC)){

				$ticketID = $row['sv_number'];
				$datecreated = $row['wo_date_created'];
				$from = $row['ticketSender'];
				$assignto = $row['assignto'];
				$subject = $row['subject'];
				$priority = $row['priority'];
				$status = $row['status'];
               $log = $row['log_ID'];


				/*Check the position of Username
					CSR 		= 0; can create/close ticket
					Supervisor 	= 1; can create work orde 
					Engineer 	= 2; can responde to work order.
									 create returnslip and pull-out

				*/

	
	         switch($stat){
  			     	case 'returned':
					 	$ticketURL = 'returnslipPDF.php?id=';
						break;
	  				case 'pullout':
						$ticketURL = 'pulloutPDF.php?id=';
  						break;
					default:
						$ticketURL = 'workorder.php?id=';
						break;
		 		}
			

	
				$tabledata .= '
				<tr id="ticketData">
                    	<th style="word-break:break-all; width:85px; height:25px;"><a href="'.$ticketURL.''.$ticketID.'&&log='.$log.'" style="color:#0099FF;">'.$ticketID.'</a></th>
                        <th style="word-break:break-all; width:85px; height:25px;">'.$datecreated.'</th>
                        <th style="word-break:break-all; height:25px;"><a href="'.$ticketURL.''.$ticketID.'&&log='.$log.'" style="color:#0099FF;">'.$subject.'</a></th>
                        <th style="word-break:break-all; width:195px; height:25px;">'.$from.'</th>
                        <th style="word-break:break-all; width:72px; height:25px;">'.$priority.'</th>
                        <th style="word-break:break-all; width:140px; height:25px;">'.$assignto.'</th>
                    </tr>
				';

			}



	}

	

?>
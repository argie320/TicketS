<?php


class ReopenTicket {
	
	public function Re_open($sv_number,$reassignTo,$reason,$reopenBy){
	
	     $result = DB::getInstance()->prepare("INSERT INTO tb_reopen(sv_number,reassignTo,reason,date_reopen,reopenBy)VALUES(?,?,?,now(),?)");
		 $result->execute(array($sv_number,$reassignTo,$reason,$reopenBy));
	
	
	}
	
	
	public function UpdateReopenStatus($sv_number,$log){
		
				$result = DB::getInstance()->prepare("UPDATE ticket_status SET isReopen = 1 WHERE ticketNo = ? AND log_ID = ?");
	             $result->execute(array($sv_number,$log));   
	}
	 
	
	
	public function UpdateTicketStatus($sv_number){
		
				$result = DB::getInstance()->prepare("INSERT INTO ticket_status(ticketNo,isCreated,isOpen,dateCreated)
	                                     VALUES(?,1,1,now())");
	             $result->execute(array($sv_number));   
	}
	 
	public function InsertHeader($custcode,$FromUser,$CurrentUserEmail,$source,$ticketStatus,$assignto,$department,
		                         $company,$Reference,$duedate,$priority,$custcode,$HelpTopic,$SLAPlan,$duetime){
	
	     $result = DB::getInstance()->prepare("INSERT INTO  sv_ticket_header (date_created,time_created,sv_number,ticketSender,ticketSenderEmail,                    source,status,assignto,department,company,reference,duedate,priority,ticketID,help_topic,slaplan,duetime)
		            VALUES (CURDATE(), CURTIME() ,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		
		 $result->execute(array($custcode,$FromUser,$CurrentUserEmail,$source,$ticketStatus,$assignto,$department,
		                         $company,$Reference,$duedate,$priority,$custcode,$HelpTopic,$SLAPlan,$duetime));
	
	}
	
	public function InsertTicketDetails($sv_number,$subject,$issue,$remarks){
	
	     $result = DB::getInstance()->prepare("INSERT INTO sv_ticket_details(sv_number,subject,issue,remarks)VALUES (?,?,?,?)");		
		 $result->execute(array($sv_number,$subject,$issue,$remarks));	
	}

    public function InsertAttachment($Queryinsert_sv_ticket_details_attachment){
	       $insert_sv_ticket_details_attachment = $Queryinsert_sv_ticket_details_attachment;  
           $e_move = DB::getInstance()->query($insert_sv_ticket_details_attachment);
               
  }
  
  
	
}

?>
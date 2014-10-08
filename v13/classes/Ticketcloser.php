<?php
/**
 * Created by PhpStorm.
 * User: AndroVonryan
 * Date: 9/22/14
 * Time: 8:33 PM
 */

class Ticketcloser {

    private $isSuccess = false;

    public function __construct(){

    }

    /**
     * Closed the Open ticket
     *
     * @param $ticketNumber
     *
     * @return int
     *
     * -1 - $ticketNumber is not yet assign
     * 0 - Ticket is already closed
     * 1 - Successfully Updated
     *
     */
	 
	public function closeTicketStatus($sv_num,$log){
		
		        $result = DB::getInstance()->prepare("UPDATE ticket_status SET isClosed = 1,isOpen = 0,dateClosed=now() 
				                          WHERE ticketNo = ? AND log_ID=?");
                $result->execute(array($sv_num,$log));
}
	 

    public function closeTicket($ticketNumber,$log){

        if(isset( $ticketNumber )) {

            if($this->checkTicketIfNotClosed($ticketNumber,$log)){


                $result = DB::getInstance()->prepare("UPDATE sv_ticket_header SET isClosed = 1 WHERE sv_number = ? AND log_ID =?");
                $result->execute(array($ticketNumber,$log));
				
				if($result){

                    $this->isSuccess = true;
                    // "Sucessfull Updated";
                    return 1;
                }

            }else{
                // "checkTicketIfNotClosed return false";
                return 0;
            }





        }else{
            // "Service Ticket ID has no value";
            return -1;
        }

    }

    private function checkTicketIfNotClosed($ticketID,$log){


        $result = DB::getInstance()->prepare("SELECT isClosed FROM sv_ticket_header WHERE sv_number = ? AND log_ID=?");

        $result->execute(array($ticketID,$log));

        if($result->rowCount()){

            foreach($result as $row){

                $status = $row['isClosed'];

                return ($status != "1") ? true : false;

            }

        }else{
            return false;
        }



    }

}



<?php
/**
 * Created by PhpStorm.
 * User: AndroVonryan
 * Date: 9/1/14
 * Time: 11:05 PM
 */

class Ticketreplay {

    private static $_service_number;
    private $_whomUsername;

    public function __construct($sv_number, $username){

        self::$_service_number = $sv_number;
        $this->_whomUsername = $username;

    }


    public function viewTicketReplay(){

        if(isset(self::$_service_number)){

            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_replay WHERE sv_number = :sv_number  ORDER BY DatePosted  ASC");

            $result->execute(array(':sv_number'  => self::$_service_number ) );

            $Comments = array();

            if($result->rowCount()){

                while($row = $result->fetch()){
                    $message = $row['message'];
                    $by              = $row['sender'];
                    $date       =   $row['DatePosted'];

                //    echo $message ."<br />";
                    $Comments[$date] = array("message"=>$message, "sender"=>$by, "DatePosted"=>$date);
                }
                return $Comments;

            }else{
                //0 - No comment yet!
                return 0;
            }

        }else{

            return -1;
        }
    }

    public function postComment($ticket_number, $message, $from){

        if(self::$_service_number != $ticket_number){
                //"Cant add the comment. ticket number does not match!";
                return -2;
        }else{

            if(isset($message)){

                $replaySQL = "INSERT INTO sv_ticket_replay(sv_number ,message, sender,  DatePosted)
                                                                                   VALUES (:sv_ticket_num,:message,:sender, NOW())";

                $addReplay = DB::getInstance()->prepare($replaySQL);
                $addReplay->execute(array(
                                                                         ':sv_ticket_num' => $ticket_number,
                                                                         ':message' =>$message,
                                                                         ':sender' =>$from
                                                                        )
                                                                );

                //Check if there is an affected row
                if($addReplay->rowCount()){
                    return 1;
                }else{
                   // "Adding comment was failed!";
                    return 0;
                }
            }else{
                //"Please Enter your message!";
                return -1;
            }

        }






    }

}

?>



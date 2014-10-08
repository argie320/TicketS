<?php
/**
 * Created by PhpStorm.
 * User: AndroVonryan
 * Date: 9/2/14
 * Time: 11:25 AM
 */

include_once('../classes/Ticketreplay.php');
include_once('../includes/config.php');
include_once('../asset/DB.php');




if(isset($_POST['postcomment'])){



    $ticket_number = $_POST['sv_number_id'];
    $mycomment = $_POST['commentbox'];
    $username = $_POST['un'];

    $comments = new Ticketreplay($ticket_number, $username);
    $displayComment = $comments->viewTicketReplay();
    //header("Location: https://www.facebook.com");


    echo $mycomment;








}

?>
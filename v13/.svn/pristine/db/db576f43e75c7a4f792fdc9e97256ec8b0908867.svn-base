<?php
/**
 * Created by PhpStorm.
 * User: AndroVonryan
 * Date: 9/6/14
 * Time: 2:43 PM
 */

include "init.php";

//Assign to Enginner Section
if(isset($_POST['assign'])){

    echo "This is the value:". $_POST['duedate'];
    ECHO $wo_duedate = Validate::escape($_POST['duedate']);

    $sv_number =  Validate::escape($_POST['svnumber']);
    $wo_priority =  Validate::escape($_POST['priority']);
    $wo_duedate = Validate::escape($_POST['duedate']);
    $wo_duetime = Validate::escape($_POST['duetime']);

    $messageToEng = Validate::escape($_POST['messageToEngineer']);

    $assigToEngineer =  Validate::escape($_POST['assignto']);
    //sleep(5);
    $ServiceTicket  = new serviceTicket();
    $isCreated = $ServiceTicket->createWorkOrder( $assigToEngineer,  $wo_duedate, $wo_duetime, $wo_priority,$messageToEng,  $sv_number);

    if($isCreated){

    }else{
        echo "Failed to create work order";
    }

}


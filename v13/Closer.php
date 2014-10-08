<?php
/**
 * Created by PhpStorm.
 * User: AndroVonryan
 * Date: 9/22/14
 * Time: 9:05 PM
 */

include "init.php";

if( isset($_POST['update'])){

    $ticketID = $_POST['ticketID'];
    $ticket = new Ticketcloser();

    if($ticket->closeTicket($ticketID)){
        echo "Sucess";
    }else{
        echo "Failed";
    }
}

?>


<html>
<head>
</head>

<body>
<form method="post" action="Closer.php">


    <input type="text" name="ticketID">
    <input type="submit" value="OK" name="update">

</form>
</body>
</html>
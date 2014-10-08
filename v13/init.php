<?php
/**
 * Created by PhpStorm.
 * User: AndroVonryan
 * Date: 9/3/14
 * Time: 1:45 PM
 */


// load error handling module
require_once('asset/error_handler.php');
include("asset/attachment.class.php");
include("asset/steadFast.class.php");
include("asset/customer.class.php");
include("classes/Person.class.php");

include_once("asset/serviceTicket.class.php");
include("asset/TicketInformation.php");
include('asset/ItemDetails.php');

require_once "includes/config.php";
include_once "asset/DB.php";
include "classes/Ticketreplay.php";
include "classes/Redirect.php";
include_once 'asset/steadFast.class.php';
include ("asset/functions.php");

include "classes/Validate.php";  
include "classes/ReopenTicket.php";

include "classes/Ticketcloser.php";

date_default_timezone_set("Etc/GMT+8"); 

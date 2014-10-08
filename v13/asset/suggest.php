<?php

include "connection.php";

function escape_data ($data) {

    global $dbc;

    if (ini_get('magic_quotes_gpc')) {
        $data = stripslashes($data);
    }

    return $data = mysqli_real_escape_string($dbc, trim($data));

}

if(isset($_POST['company'])){


    $company = preg_replace('#[^a-zA-Z0-9 ]#i',  '' ,$_POST['company']);

    $sql = "SELECT *
FROM tbcustomer
WHERE customer_company LIKE  '".$company."%' ";

    $result = mysqli_query($dbc, $sql);


    $company_check = mysqli_num_rows($result);

    $resultarray = array();
    if($company_check > 0){

        while ($curarray = $result->fetch_assoc()) {

            $CustomerName = $curarray['customer_name'];
            $EmailAddress = $curarray['customer_email'];
            $ContactNumber = $curarray['customer_cnum'];
            $FaxNo = $curarray['customer_fnum'];
            $Address = $curarray['customer_baddr'];
            $ContactPerson = $curarray['customer_contact'];

            $resultarray[$CustomerName] = array();
            $resultarray[$EmailAddress] = array();
            $resultarray[$ContactNumber] = array();
            $resultarray[$FaxNo] = array();
            $resultarray[$Address] = array();
            $resultarray[$ContactPerson] = array();
        }

        echo '<pre>';
        print_r($resultarray);
        echo '</pre>';


    }else{
        echo 'No Record Found!';
    }

}




?>


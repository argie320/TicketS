<?php


if(isset($_SESSION['username'])){
    $checkPosition = DB::getInstance()->getInstance()->prepare("SELECT * FROM gagamit WHERE user_name=?");
    $checkPosition->execute(array($_SESSION['username']));

    if($checkPosition->rowCount()){

        foreach($checkPosition as $row){

            $userPosition = $row['position'];

            if(is_numeric($userPosition) && isset($userPosition)){

                switch($userPosition){
                    case 0:
                        include "CSRHeader.php";
                        break;
                    case 1:
                        include "supervisorHeader.php";
                        break;
                    case 2:
                        include "EngineerHeader.php";
                        break;
                    case 3:
                        include "adminHeader.php";
                        break;
                    default:
                        Redirect::to(1, null);
                }
            }else{
                Redirect::to(1, null);
            }

        }
    }
}else{
    Redirect::to(1, null);
}



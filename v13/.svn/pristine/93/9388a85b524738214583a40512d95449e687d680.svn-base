<?php
/**
 * Created by PhpStorm.
 * User: AndroVonryan
 * Date: 9/2/14
 * Time: 4:19 PM
 */

class Redirect {

    public static function to($location = null, $specificPath ){

        if($location){
            if(is_numeric($location)){
                switch($location){
                    case 404:
                            header("Location: 404.php ");
                            exit();
                        break;
                    case 0:
                            header("Location: login.php");
                            exit();
                        break;
                    case 5:
                            header("Location: ".$specificPath."");
                            exit();
                        break;

                }

            }
        }
    }

} 
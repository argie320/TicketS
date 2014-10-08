<?php
/**
 * Created by PhpStorm.
 * User: AndroVonryan
 * Date: 9/6/14
 * Time: 2:13 PM
 */

class Validate {

    public static function escape($value){

        if( isset($value) ){
           return  htmlspecialchars(  trim( $value ) ,  ENT_QUOTES);
        }else{
            return "Undefined";
        }

    }

} 
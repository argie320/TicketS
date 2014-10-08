<?php
/**
 * Created by PhpStorm.
 * User: AndroVonryan
 * Date: 8/28/14
 * Time: 5:10 PM
 */
function AutoloadPHPFile($classname)
{
    //Can't use __DIR__ as it's only in PHP 5.3+
    $filename = dirname(__FILE__).DIRECTORY_SEPARATOR.'class.'.strtolower($classname).'.php';
    if (is_readable($filename)) {
        require $filename;
    }
}


spl_autoload_register(function ($class){
    AutoloadPHPFile($class);
});





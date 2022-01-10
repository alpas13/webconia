<?php

session_start();

function classAutoloader($class)
{

    if (file_exists('controls/' . $class . '.class.php'))
    {
        include_once 'controls/' . $class . '.class.php';
    }
    else if (file_exists('model/' . $class . '.class.php'))
    {
        include_once 'model/' . $class . '.class.php';
    }
    else
    {
        echo "The class: $class not found";
        die;
    }

}

spl_autoload_register('classAutoloader');
?>

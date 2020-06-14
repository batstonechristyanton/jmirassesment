<?php 
/***
 * here i incorporate all the required folders and using dot env enviroment for the databse connection 
 * 
 * Require the autoload folder to use name space 
 *  
 * 
 * ***/
use Dotenv\Dotenv;



require '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));

$dotenv->load();
?>


 
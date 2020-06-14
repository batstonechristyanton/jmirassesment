<?php 
/***
 * here i incorporate all the required folders and using dot env
 * enviroment for the databse connection 
 * ***/

//to fix the cors error when sending a response back to the browser this has been added to the file
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
use Dotenv\Dotenv;

require '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));

$dotenv->load();
?>


 
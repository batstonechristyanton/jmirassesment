<?php
// setup the file so i do not need to use required for database and connection in the 

use App\Database;
use App\Connection;
require('../Core/bootstrap.php');
$con = Connection::connect();
$db = new Database($con);

// grabbing the required information from the post that the api sends in from the vue framework
$_POST = json_decode(file_get_contents('php://input'), true);

//sending the grabed information from the api to the database
if(isset($_POST['name'])){
        $fromVue = $_POST['name'];
      $db->insertDataFromCrossRef($fromVue);

    echo("i got the data ");  
}

else{
    echo 'data not received';
}
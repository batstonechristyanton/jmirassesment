<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$_POST = json_decode(file_get_contents('php://input'), true);


if(isset($_POST['name'])){
 
    $fromVue = $_POST['name'];
    foreach( $fromVue as $values){

        $values["given"];
        $values["family"];
        $values["sequence"];

     
    }

    echo("i got the data ");
}
    

else{
    echo 'data not received';
}
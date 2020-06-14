<?php 
/***
 * this file produces the diffrent methods to do specific actions like selecting * the information from the db and displaying
 * ***/
namespace App;

use PDO;

use GuzzleHttp\Client;
use LengthException;

class Database{
    protected $query;
    protected PDO $con;
    
    
    public function __construct($con){ 
        $this->con = $con;
    }
        
    public function getallCross_ref(){
        
        $query= 'SELECT * FROM Cross_ref';
        $stmt = $this->con->query($query); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function getallNcbi(){
        
        $query= 'SELECT * FROM Ncbi';
        $stmt = $this->con->query($query); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

       public function insertDataFromCrossRef($fromVue){
 
             foreach($fromVue as $values){
                 
                 $query = "INSERT IGNORE INTO Cross_ref (given,family,seq)Values(:given,:family,:seq)";
                  $stmt= $this->con->prepare($query); 
                  $stmt->bindparam( ":given", $values["given"], PDO::PARAM_STR );
                  $stmt->bindparam( ":family", $values["family"], PDO::PARAM_STR );
                  $stmt->bindparam( ":seq", $values["sequence"], PDO::PARAM_STR );
                  $stmt->execute();                  
                }
        
                   
    }
        
    
    
    
    
}
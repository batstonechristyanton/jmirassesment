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
    

    public function FilteringArrayRdyToInserrt (){


        $client = new Client(['base_uri' => 'https://api.crossref.org/works/']); 
    
        
        $response = $client->request('GET', '10.2196/12121');
        $body = $response->getBody();
        $data = json_decode($body,true);
          
        $authors = array_filter( $data['message']['reference'],function($reference){
            return isset($reference['family']);
        });
    
        $data = array_map(function($family){
            return ["family" => $family['family'], 'key' => $family['key']];
        }, $authors);
    
        echo '<pre>';
            die(var_dump($data));
            echo '</pre>';
        
    
                
            print_r($data['message']['reference']);

    }

    public function insertDataFromCrossRef(){
        
        $msg['message'] = '';    
         $body="";
       

                        
            if(isset($body->given)|| isset($body->family) || isset($body->sequence)){

                echo '<pre>';
                    die(var_dump($body->given));
                    echo '</pre>';
                
           
            if(!empty($body->given) &&!empty($body->family) && isset($body->sequence)){

               $query= "INSERT INTO `Cross_ref` (given,family,sequence) Values:(:given-title,:family,sequence)";

               $insert_stmt= $this->con->prepare($query);

                    // DATA BINDING
                $insert_stmt->bindValue(':given', htmlspecialchars(strip_tags($body->{"given-title"})),PDO::PARAM_STR);
                $insert_stmt->bindValue(':family', htmlspecialchars(strip_tags($body->family)),PDO::PARAM_STR);
                $insert_stmt->bindValue(':sequence', htmlspecialchars(strip_tags($body->sequence)),PDO::PARAM_STR);
                
                if($insert_stmt->execute()){
                    $msg['message'] = 'Data Inserted Successfully';
                }else{
                    $msg['message'] = 'Data not Inserted';
                } 
                
            }else{
                $msg['message'] = 'Oops! empty field detected. Please fill all the fields';
            }
        }
        else{
            $msg['message'] = 'Please fill all the fields | title, body, family';
        }
        
    
    }
        
    
    
    
    
}
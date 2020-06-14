<?php 
/***
 * in this file i setup the database connection and make them al env variable so when i pass in the db information through Env
 * it will have all the necessary details for the connection to work.
 *  
 ****/

namespace App;

use PDO;

class Connection{


    public static function connect() : PDO{
        $dsn ="mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset={$_ENV['DB_CHARSET']}";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try{

            
             return new PDO(
                        $dsn,
                        $_ENV['DB_USER'],
                        $_ENV['DB_PASS'],
                        $options
                    );
                
        }catch(\PDOException $e){
            throw new \PDOException($e->getMessage(),(int)$e->getCode());
        }
    }
}
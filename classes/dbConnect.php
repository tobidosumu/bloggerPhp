<?php

    class DbConnect 
    {
        protected function connect()
        {
            try 
            {
                $username = 'root';
                $password = '';
                $dbConn = new PDO('mysql:host=localhost;dbname=blogger', $username, $password);
                return $dbConn;
            } 
            catch (PDOException $e)
            {
                print "Connection failed: " . $e->getMessage() . "<br>";
                die();
            }
        }
    }
    // if (!defined("DB_TYPE")) {
    //     define("DB_TYPE", "mysql");
    // }
    // if (!defined("DB_HOST")) {
    //     define("DB_HOST", "localhost");
    // }
    // if (!defined("DB_USER")) {
    //     define("DB_USER", "root");
    // }
    // if (!defined("DB_PWD")) {
    //     define("DB_PWD", "");
    // }
    // if (!defined("DB_NAME")) {
    //     define("DB_NAME", "blogger");
    // }
?>
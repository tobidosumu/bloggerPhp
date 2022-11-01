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

?>
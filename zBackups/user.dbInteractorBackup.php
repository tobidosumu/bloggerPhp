<?php 
    require_once 'dbConnect.php';

    class UserDbInteractor
    {
        protected $dbConn;
        private $data;
        // private static $fields = ['firstName', 'lastName', 'email', 'password', 'confirmPassword'];

        public function __construct($postaData)
        {
            $this->data = $postaData;
            $this->dbConn = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PWD,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        }
        
        public function InsertUserData() // Insert blog data
        {
            try {
                $stmt = $this->dbConn->prepare("INSERT INTO user(firstName, lastName, email, password, confirmPassword)
                VALUES(?, ?, ?, ?, ?)");
                
                if($stmt->execute([$this->data['firstName'], $this->data['lastName'], $this->data['email'], $this->data['password'], $this->data['confirmPassword']]))
                {
                    // print_r($_SESSION['hashedConfirmPassword']);
                    // $_SESSION['hashedConfirmPassword'];
                    // die('Post uploaded successfully!');

                }
            } catch (Exception $e) {
                echo "failed";
                return $e->getMessage();
            }
        }

        public function fetchAll() // fetch all data from blog_post table
        {
            try {
                $stmt = $this->dbConn->prepare("SELECT * FROM blog_post");
                $stmt->execute();
                return $stmt->fetchAll();
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }
?>
<?php 
    require_once 'dbConnect.php';

    class UserDbQuery extends DbConnect
    {
        private $firstName;
        private $lastName;
        private $email;
        private $password;

        ###################################################################################################
        // setter and getter methods start here

        public function setFirstName($firstName)
        {
            $this->firstName = $firstName;
        }

        public function setLastName($lastName)
        {
            $this->lastName = $lastName;
        }

        public function setEmail($email)
        {
            $this->email = strtolower($email);
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function setConfirmPassword($confirmPassword)
        {
            $this->password = $confirmPassword;
        }


        #####################################################################################################
        // validation methods start here

        public function insertUserData() // Insert blog data
        {
            try 
            {
                $stmt = $this->connect()->prepare("INSERT INTO user(firstName, lastName, email, password)
                VALUES(?, ?, ?, ?)");
                $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
                $stmt->execute([$this->firstName, $this->lastName, $this->email, $hashedPassword]);
                return "Successful";
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }

        // public function checkEmailPasswordExist($email, $password)
        // {
        //     $stmt = $this->connect()->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
        //     $stmt->execute([$email, $password]);
        //     $user = $stmt->fetch();

        //     if ($user) 
        //     {
        //         return "success";
        //     }
        //     else 
        //     {
        //         return "unsuccessful";
        //     }
        // }
    }
?>
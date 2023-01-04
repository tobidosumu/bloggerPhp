<?php 
    require_once 'dbConnect.php';

    class UserDbQuery extends DbConnect
    {
        private $userId;
        private $firstName;
        private $lastName;
        private $email;
        private $password;

        ###################################################################################################
        // setter and getter methods start here
        public function setId($userId)
        {
            $this->userId = $userId;
        }

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
        // Database query methods start here

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

        public function fetchOne() // Fetch one set of user data i.e. id, firstName, lastName, email, password
        {
            try 
            {
                // Prepare and execute the SQL statement to fetch the user data
                $stmt = $this->connect()->prepare("SELECT * FROM user WHERE userId = ?");
                $stmt->execute([$this->userId]);
                return $stmt->fetch();
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }

        public function getUserFirstName($id) // Fetch a user's firstName
        {
            try 
            {
                $stmt = $this->connect()->prepare("SELECT firstName FROM user WHERE id=?");
                $stmt->execute([$id]);
                $user = $stmt->fetch();
                return $user['firstName'];
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }
        
        
        
    }
?>
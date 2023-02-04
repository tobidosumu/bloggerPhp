<?php 
    require_once 'dbConnect.php';

    class UserDbQuery extends DbConnect
    {
        private $user_id;
        private $firstName;
        private $lastName;
        private $email;
        private $password;

        ###################################################################################################
        // setter and getter methods start here
        public function setId($user_id)
        {
            $this->user_id = $user_id;
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
                $stmt = $this->connect()->prepare("INSERT INTO users(firstName, lastName, email, password)
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

        public function fetchOne() // Fetch one set of user data i.e. user_id, firstName, lastName, email, password
        {
            try 
            {
                // Prepare and execute the SQL statement to fetch the user data
                $stmt = $this->connect()->prepare("SELECT * FROM users WHERE user_id = ?");
                $stmt->execute([$this->user_id]);
                return $stmt->fetch();
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }

        public function getFullNames()
        {
            try 
            {
                $stmt = $this->connect()->prepare("SELECT firstName, lastName FROM users");
                $stmt->execute();
                $users = $stmt->fetchAll();
                $firstNames = array_column($users, 'firstName', 'lastName');
                return $firstNames;
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }

        public function getAllFirstNames()
        {
            try 
            {
                $stmt = $this->connect()->prepare("SELECT firstName FROM users");
                $stmt->execute();
                $users = $stmt->fetchAll();
                $firstNames = array_column($users, 'firstName');
                return $firstNames;
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }        

        public function getAllLastNames()
        {
            try 
            {
                $stmt = $this->connect()->prepare("SELECT lastName FROM users");
                $stmt->execute();
                $users = $stmt->fetchAll();
                $lastNames = array_column($users, 'lastName');
                return $lastNames;
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }  
        
        
        
    }
?>
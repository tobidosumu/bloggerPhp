<?php 
    require_once 'dbConnect.php';

    class UserDbQuery extends DbConnect
    {
        // protected $dbConn;
        // private $data;
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
            } 
            catch (Exception $e) 
            {
                // echo "failed";
                return $e->getMessage();
            }
        }

        public function checkEmailExist() // checks if user exists via user's email
        {
            $stmt = $this->connect()->prepare("SELECT COUNT(*) AS count FROM `user` WHERE email=?");
            $stmt->execute(array($this->email));
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $email_count = $row["count"];
            }
            if ($email_count > 0) {
                echo "That email address is already in use";
            }
        }

        public function checkEmailPasswordExist()
        {
            $stmt = $this->connect()->prepare("SELECT * FROM user WHERE email = ?");
            $stmt->execute([$this->email]);
            $user = $stmt->fetch();

            if ($user && password_verify($this->password, $user['password']))
            {
                print_r(
                    '<div class="loginAlert position-absolute mt-5 top-0 start-50 translate-middle alert d-flex align-items-center" role="alert">
                        <div>
                            <i class="bi bi-hand-thumbs-up-fill"></i>
                            Login successful!
                        </div>
                    </div>'
                );
                header('Refresh:3; url=./main.php');
            }
            else {
                print_r(
                    '<div class="myAlert position-absolute mt-5 top-0 start-50 translate-middle alert alert-danger d-flex align-items-center" role="alert">
                        <div>
                            <i class="bi bi-emoji-frown-fill"></i>
                            Login Failed!
                        </div>
                    </div>'
                );
                // header('Refresh:3; url=./login.php');
            }
        }
    }
?>
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
        private $confirmPassword;


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
            $this->email = $email;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function setConfirmPassword($confirmPassword)
        {
            $this->confirmPassword = $confirmPassword;
        }


        #####################################################################################################
        // validation methods start here

        public function insertUserData() // Insert blog data
        {
            try {
                $stmt = $this->connect()->prepare("INSERT INTO user(firstName, lastName, email, password, confirmPassword)
                VALUES(?, ?, ?, ?, ?)");
                
                $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

                if ($stmt->execute([$this->firstName, $this->lastName, $this->email, $hashedPassword, $hashedPassword]))
                {
                    print_r(
                        '<div class="myAlert position-absolute mt-5 top-0 start-50 translate-middle alert d-flex align-items-center" role="alert">
                            <div>
                                <i class="bi bi-hand-thumbs-up-fill"></i>
                                Congratulations! Account created successfully!
                            </div>
                        </div>'
                    );

                    header('Refresh:3; url=./main.php');
                    // header('Refresh:3; url=./login.php');
                }
            } catch (Exception $e) {
                echo "failed";
                return $e->getMessage();
            }
        }

        protected function checkUser() // checks if user exists in the db
        {
            $stmt = $this->connect()->prepare('SELECT FROM user WHERE firstName = ? OR lastName = ? OR email = ?');

            if (!$stmt->execute([$this->firstName, $this->lastName, $this->email]))
            { // if no results were fetched from db
                // print_r($stmt);
                // $stmt = null;
                header('Location:../index.php?error=stmtfailed');
                exit();
            }

            if ($stmt->rowCount() > 0) // $resultCheck; // checks if user data was fetched
            {
                $resultCheck = false; // deny sign up if user data already exist
            }
            else
            {
                $resultCheck = true;
            }

            return $resultCheck;
        }

        public function checkEmailPasswordExist()
        {
            $stmt = $this->connect()->prepare( "SELECT * FROM user LIMIT ?, ?" );
            $stmt->execute([$this->email, $this->password]);

            if( $stmt->rowCount() > 0 ) { // if rows are found for query
                print_r(
                    '<div class="myAlert position-absolute mt-5 top-0 start-50 translate-middle alert alert-success d-flex align-items-center" role="alert">
                        <div>
                            <i class="bi bi-hand-thumbs-up-fill"></i>
                            Login successful!
                        </div>
                    </div>'
                );

                header('Refresh:4; url=../index.php');
            }
            else {
                print_r("Email not found!");
            }
        }
    }
?>
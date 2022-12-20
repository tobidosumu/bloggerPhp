<?php

    require 'user.dbQuery.php';

    class UserSignupValidator extends UserDbQuery 
    {
        private $firstName;
        private $lastName;
        private $email;
        private $password;
        private $confirmPassword;
        private $errors = [];

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

        public function validateUserSignup()
        {
            $this->validateFirstName();
            $this->validateLastName();
            $this->validateEmail();
            $this->validatePassword();
            $this->validateConfirmPassword();
            return $this->errors;
        }

        private function validateFirstName() // validates firstName
        {
            $val = trim($this->firstName);
            
            $onlyDigits = preg_replace('/\\D/', '', $val);
            $numLength = strlen($onlyDigits);
     
            if (empty($val))
            {
                $this->addError('firstName', 'First name cannot be empty.');
            }
            elseif (!preg_match('(.*[a-z]|[A-Z])', $val))
            {
                $this->addError('firstName', 'First name must include letters.');
            }
            // elseif (strlen($val) < 3)
            // {
            //     $this->addError('firstName', 'must be at least 3 characters in length.');
            // }
            // elseif ($numLength > 1)
            // {
            //     $this->addError('firstName', 'cannot include more than 1 number.');
            // }
            elseif ($numLength > 2 || strlen($val) < 3)
            {
                $this->addError('firstName', 'First name must be at least 3  letters long.');
            }
        }

        private function validateLastName() // validates lastName
        {
            $val = trim($this->lastName);
            
            $onlyDigits = preg_replace('/\\D/', '', $val);
            $numLength = strlen($onlyDigits);
     
            if (empty($val))
            {
                $this->addError('lastName', 'Last name cannot be empty.');
            }
            elseif (!preg_match('(.*[a-z]|[A-Z])', $val))
            {
                $this->addError('lastName', 'Last name must include letters.');
            }
            elseif (strlen($val) < 3)
            {
                $this->addError('lastName', 'must be at least 3 characters in length.');
            }
            elseif ($numLength > 1)
            {
                $this->addError('lastName', 'cannot include more than 1 number.');
            }
            elseif ($numLength > 2 || strlen($val) < 3)
            {
                $this->addError('lastName', 'Last name must be at least 3 letters long.');
            }
        }

        private function validateEmail() // validates email
        {
            $val = trim($this->email);  
            $val = strtolower($val);

            // if (empty($val)) $this->addError('email', 'Email cannot be empty.');

            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) $this->addError('email', 'Email is not valid or cannot be empty.');

            if ($this->checkEmailExist()) $this->addError('email', 'This email already exists.');
        }

        private function validatePassword() // validates password
        {
            $val = trim($this->password);

            if (empty($val))
            {
                $this->addError('password', 'Password cannot be empty.');
            }
            elseif (strlen($val) < 8)
            {
                $this->addError('password', 'must be at least 8 characters in length.'); 
            }
            elseif (!preg_match('(.*[0-9]|[0-9])', $val))
            {
                $this->addError('password', 'Password must contain at least one number.');
            } 
            elseif (!preg_match('(.*[A-Z])', $val))
            {
                $this->addError('password', 'must include at least one uppercase letter.');
            } 
            elseif (!preg_match('(.*[a-z])', $val))
            {
                $this->addError('password', 'must include at least one lowercase letter.');
            }
            elseif(!preg_match('([!@#$%^&*(),.?":{}|<>])', $val))
            {
                $this->addError('password', 'must include at least one special character.');
            }
        }

        private function validateConfirmPassword() // validates confirmPassword
        {
            $password = $this->password;
            $confirmPassword = $this->confirmPassword;
            
            if (empty($confirmPassword))
            {
                $this->addError('confirmPassword', 'Confirm password cannot be empty.');
            } 
            elseif ($confirmPassword !== $password)
            {
                $this->addError('confirmPassword', 'Both passwords do not match.');
            }
        }

        private function addError($key, $val) // receives errors in key(field) and value(error message) pair
        {
            $this->errors[$key] = $val;
        }

        public function checkEmailExist() // checks if user exists via user's email
        {
            $stmt = $this->connect()->prepare("SELECT COUNT(*) AS count FROM `user` WHERE email=?");
            $stmt->execute(array($this->email));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $emailCount = $row["count"];

            return $emailCount > 0;
        }
    }

?>
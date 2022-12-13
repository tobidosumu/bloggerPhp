<?php

    require 'user.dbQuery.php';

    class UserLoginValidator extends UserDbQuery 
    {
        private $email;
        private $password;
        private $errors = [];

        public function validateUserLogin()
        {
            $this->validateEmail();
            $this->validatePassword();
            return $this->errors;
        }

        // Setters
        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        private function validateEmail() // validates email
        {
            $val = trim($this->email);

            if (empty($val))
            {
                $this->addError('email', 'Email cannot be empty.');
            }
            else 
            {
                $this->addError('email', 'Email does not match.');
            }
        }

        private function validatePassword() // validates password
        {
            $val = trim($this->password);

            if (empty($val))
            {
                $this->addError('password', 'Password cannot be empty.');
            }
            else
            {
                $this->addError('password', 'Password does not match.'); 
            }
        }

        private function addError($key, $val) // receives errors in key(field) and value(error message) pair
        {
            $this->errors[$key] = $val;
        }
    }

?>
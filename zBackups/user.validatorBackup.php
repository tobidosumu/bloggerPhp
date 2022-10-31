<?php

    class UserValidator {
        private $data;
        private $errors = [];
        private static $fields = ['firstName', 'lastName', 'email', 'password', 'confirmPassword'];

        public function __construct($postData)
        {
            $this->data = $postData;
        }

        public function validateUserData()
        {
            foreach (self::$fields as $field)
            {
                if (!array_key_exists($field, $this->data))
                {
                    trigger_error("$field does not exist.");
                    return;
                }
            }
            $this->validateFirstName();
            $this->validateLastName();
            $this->validateEmail();
            $this->validatePassword();
            $this->validateConfirmPassword();
            return $this->errors;
        }

        private function validateFirstName() // validates firstName
        {
            $val = trim($this->data['firstName']);
            
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
            elseif (strlen($val) < 3)
            {
                $this->addError('firstName', 'must be at least 3 characters in length.');
            }
            elseif ($numLength > 1)
            {
                $this->addError('firstName', 'cannot include more than 1 number.');
            }
            elseif ($numLength > 2 || strlen($val) < 3)
            {
                $this->addError('firstName', 'First name must be at least 3  letters long.');
            }
        }

        private function validateLastName() // validates lastName
        {
            $val = trim($this->data['lastName']);
            
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
            $val = trim($this->data['email']);

            if (empty($val))
            {
                $this->addError('email', 'Email cannot be empty.');
            }
            else 
            {
                if (!filter_var($val, FILTER_VALIDATE_EMAIL))
                {
                    $this->addError('email', 'Email is not valid (@ is missing).');
                }
            }
        }

        private function validatePassword() // validates password
        {
            $val = trim($this->data['password']);

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
            $password = $this->data['password'];
            $confirmPassword = $this->data['confirmPassword'];

            // print_r($password ."<br>");
            // print_r($confirmPassword ."<br>");
            // die('stop here');
            
            if ($confirmPassword !== $password)
            {
                $this->addError('confirmPassword', 'Both passwords do not match.');
            } 
            // elseif ($_SESSION['hashedConfirmPassword'])
            // {
            //     $_SESSION['hashedConfirmPassword'] = password_hash($confirmPassword, PASSWORD_DEFAULT);
            // }
            


            // print_r($hashedPassword ."<br>");
            // print_r($_SESSION['hashedConfirmPassword'] ."<br>");
            // die('stop here');

            // $verifiedPassword = password_verify($password, $hashedPassword);
            // $verifiedConfirmPassword = password_verify($confirmPassword, $hashedConfirmPassword);
            
            // print_r($hashedPassword  ."<br>");
            // print_r($hashedConfirmPassword ."<br>");
            // print_r($verifiedPassword  ."<br>");
            // print_r($verifiedConfirmPassword ."<br>");
            // die('stop here');
            // return;
        }

        private function addError($key, $val) // receives errors in key(field) and value(error message) pair
        {
            $this->errors[$key] = $val;
        }
    }

?>
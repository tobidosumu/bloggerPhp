<?php

    require 'user.dbQuery.php';

    class UserSignupValidator extends UserDbQuery 
    {
        private $data;
        private $errors = [];
        private static $fields = ['firstName', 'lastName', 'email', 'password', 'confirmPassword'];

        public function __construct($postData)
        {
            $this->data = $postData;
        }

        public function validateUserSignup()
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
                    $this->addError('email', 'Email is not valid.');
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
    }

?>
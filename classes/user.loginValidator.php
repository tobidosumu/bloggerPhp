<?php

    require 'user.dbQuery.php';

    class UserLoginValidator extends UserDbQuery 
    {
        private $data;
        private $errors = [];
        private static $fields = ['email', 'password'];

        public function __construct($postData)
        {
            $this->data = $postData;
        }

        public function validateUserLogin()
        {
            foreach (self::$fields as $field)
            {
                if (!array_key_exists($field, $this->data))
                {
                    trigger_error("$field does not exist.");
                    return;
                }
            }
            $this->validateEmail();
            $this->validatePassword();
            return $this->errors;
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

        private function addError($key, $val) // receives errors in key(field) and value(error message) pair
        {
            $this->errors[$key] = $val;
        }
    }

?>
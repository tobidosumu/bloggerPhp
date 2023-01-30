<?php

  require 'user.dbQuery.php';

  class UserLoginValidator extends UserDbQuery {
    private $email;
    private $password;
    private $errors = [];
  
    public function validateUserLogin() {
      $this->validateEmail();
      $user_details = $this->validatePassword();
      $errors = $this->errors;
      if (!is_null($user_details))
      {
          unset($user_details['password']);
      }
      return array($errors, $user_details);
    }
  
    // Setters
    public function setEmail($email) {
      $this->email = $email;
    }
  
    public function setPassword($password) {
      $this->password = $password;
    }
  
    private function validateEmail() {
      $email = trim($this->email);
  
      if (empty($email)) {
        $this->addError('email', 'Email cannot be empty.');
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->addError('email', 'Email is not valid.');
      } elseif (!$this->emailExists()) {
        $this->addError('email', 'Email not associated with this account.');
      }
    }
  
    private function emailExists() {
      $emailExists = false;
      $stmt = $this->connect()->prepare("SELECT COUNT(*) AS count FROM `users` WHERE email=?");
      $stmt->execute(array($this->email));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row["count"] > 0) {
        $emailExists = true;
      }
      return $emailExists;
    }
  
    private function validatePassword() {
      $password = $this->password;
      if (empty($password)) {
        $this->addError('password', 'Password cannot be empty.');
      } else {
        $stmt = $this->connect()->prepare("SELECT * FROM `users` WHERE email=?");
        $stmt->execute(array($this->email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (is_array($row)) {
          $hashedPassword = $row["password"];
          if (is_null($hashedPassword) || $hashedPassword === '') {
            $this->addError('password', 'Invalid Password.');
          } elseif (!password_verify($password, $hashedPassword)) {
            $this->addError('password', 'Invalid Password.');
          }
          return $row;
        } else {
          $this->addError('password', 'Invalid Password.');
        }
      }
      return null;
    }

    private function validateUserDetails()
    {

    }
              
    private function addError($key, $val) {
      $this->errors[$key] = $val;
    }
  }      

?>
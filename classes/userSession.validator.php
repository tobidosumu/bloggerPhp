<?php
    
    class UserSessionValidator
    {
        public function logOutUser()
        {
          // Start the session
          session_start();
    
          // Unset all session variables
          $_SESSION = array();
    
          // Destroy the session
          session_destroy();
    
          // Expire the session cookie
          setcookie(session_name(), '', time() - 3600);
    
          // Redirect the user to the login page
          header('Location: ./login.php');
          exit;
        }
    }
?>
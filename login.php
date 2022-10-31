<?php 
    session_start();

    include './header/loginHeader.php';
    require './classes/user.loginValidator.php';
    require_once './classes/user.dbQuery.php';
    
    if(isset($_POST['loginUser']))
    {
        $loginValidation = new UserLoginValidator($_POST);
        $errors = $loginValidation->validateUserLogin();

        if (!$errors)
        {
            $loginValidation = new UserDbQuery($_POST);
            $checkEmail = $loginValidation->checkEmailPasswordExist();
        }
    }

    // print_r($_SESSION['hashedConfirmPassword']);

?>

<body>
    <section class="d-flex">
        <aside id="leftAside">
            <div class="d-flex align-items-start"><h2>Login to </h2><img class="img-fluid" src="./assets/svg/bloggerLogoWhite.svg" alt="blogger logo"></div>
        </aside>

        <aside id="rightAside">
            <div class="header d-flex justify-content-end align-items-center">
                <a href="signup.php">Don't have an account?</a>
                <a href="signup.php" class="btn rounded-1" href="#">Signup</a>
            </div>
            <div class="formWrapper d-flex flex-column">
                <div class="formContents d-flex flex-column">
                    <h2 class="py-4">Login to your account</h2>
                    <form action="" method="post"> <!-- signup form -->
                        <div>
                            <label for="email">Email address <b class="text-danger">* </b><span class="text-danger"><?=$errors['email'] ?? '' ?></span></label>
                            <input type="text" name="email" value="" placeholder="Your email address">
                        </div>
                        <div>
                            <label for="password">Password <b class="text-danger">* </b><span class="text-danger"><?=$errors['password'] ?? '' ?></span></label>
                            <input type="text" name="password" value="" placeholder="Your password">
                        </div>
                        <div class="createAcctBtn mt-4">
                            <input type="submit" name="loginUser" class="btn rounded-1" value="Login to account">
                            <a href="#" class="mt-2 ms-2">Forgot password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </aside>

    </section>
</body>
<?php 
    session_start();

    include './header/signupHeader.php';
    require './classes/user.signupValidator.php';
    require_once './classes/user.dbQuery.php';
    
    if(isset($_POST['addNewUser']))
    {
        $signupValidation = new UserSignupValidator($_POST);
        $errors = $signupValidation->validateUserSignup();

        if (!$errors)
        {
            $saveVerifiedData = new UserDbQuery($_POST);
            $validData = $saveVerifiedData->insertUserData();
        }
    }

?>

<body>
    <section class="d-flex">
        <aside id="leftAside">
            <div class="d-flex align-items-start"><h2>Welcome to </h2><img class="img-fluid" src="./assets/svg/bloggerLogoWhite.svg" alt="blogger logo"></div>
        </aside>

        <aside id="rightAside">
            <div class="header d-flex justify-content-end align-items-center">
                <a href="login.php">Already have an account?</a>
                <a href="login.php" class="btn rounded-1">Log in</a>
            </div>
            <div class="formWrapper d-flex flex-column">
                <div class="formContents d-flex flex-column">
                    <h2 class="py-4">Create your free account</h2>
                    <form action="" method="post"> <!-- signup form -->
                        <div>
                            <label for="firstName">First name <b class="text-danger">* </b><span class="text-danger"><?=$errors['firstName'] ?? ''?></span></label>
                            <input type="text" name="firstName" value="<?=$_POST['firstName'] ?? ''?>" placeholder="Your first name">
                        </div>
                        <div>
                            <label for="lastName">Last name <b class="text-danger">* </b><span class="text-danger"><?=$errors['lastName'] ?? '' ?></label>
                            <input type="text" name="lastName" value="<?=$_POST['lastName'] ?? ''?>" placeholder="Your last name">
                        </div>
                        <div>
                            <label for="email">Email address <b class="text-danger">* </b><span class="text-danger"><?=$errors['email'] ?? '' ?></span></label>
                            <input type="text" name="email" value="<?=$_POST['email'] ?? ''?>" placeholder="Your email address">
                        </div>
                        <div>
                            <label for="password">Password <b class="text-danger">* </b><span class="text-danger"><?=$errors['password'] ?? '' ?></span></label>
                            <input type="text" name="password" value="<?=$_POST['password'] ?? ''?>" placeholder="Your password">
                        </div>
                        <div>
                            <label for="confirmPassword">Comfirm password <b class="text-danger">* </b><span class="text-danger"><?=$errors['confirmPassword'] ?? '' ?></span></label>
                            <input type="text" name="confirmPassword" value="<?=$_POST['confirmPassword'] ?? ''?>" placeholder="Confirm password">
                        </div>
                        <div class="createAcctBtn mt-4"><input type="submit" name="addNewUser" class="btn rounded-1" value="Create your account"></div>
                    </form>
                </div>
            </div>
        </aside>

    </section>
</body>
<?php 
    require './classes/user.signupValidator.php';
    require_once './classes/user.dbQuery.php';

    $signupFailed = '';

    if(isset($_POST['addNewUser']))
    {
        $signupValidation = new UserSignupValidator();
        $signupValidation->setFirstName($_POST['firstName']);
        $signupValidation->setLastName($_POST['lastName']);
        $signupValidation->setEmail($_POST['email']);
        $signupValidation->setPassword($_POST['password']);
        $signupValidation->setConfirmPassword($_POST['confirmPassword']);
        $errors = $signupValidation->validateUserSignup();

        if (!$errors) 
        {
            $emailValidator = new UserDbQuery();
            $emailValidator->setFirstName($_POST['firstName']);
            $emailValidator->setLastName($_POST['lastName']);
            $emailValidator->setEmail($_POST['email']);
            $emailValidator->setPassword($_POST['password']);
            
            $returnValue = $emailValidator->insertUserData();

            if ($returnValue === "Successful")
            {
                header('location:./login.php');
            } else {
                $signupFailed = true;
            }
        }
        else {
            $signupFailed = true;
        }
    }

?>

<?php include './headers/signupHeader.php';?>
<body>
    <?php if ($signupFailed):?>
        <div class="failAlert position-absolute mt-5 top-0 start-50 translate-middle alert alert-danger d-flex align-items-center" role="alert">
            <p><i class="bi bi-emoji-frown me-1"></i> Sign up failed</p>
        </div>
    <?php endif?>

    <section class="d-flex">
        <aside class="leftAside d-flex flex-column justify-content-center align-items-center">
            <img class="img-fluid" src="assets/svg/signupBgIcon.svg" alt="signup image">
            <div class="d-flex justify-content-center align-items-center"><h2>Welcome to </h2><img class="img-fluid ms-1" src="assets/svg/bloggerLogoWhite.svg" alt="blogger logo"></div>
        </aside>

        <aside id="rightAside">
            <div class="header d-flex justify-content-end align-items-center">
                <p>Already have an account?</p>
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
                            <input type="password" name="password" value="<?=$_POST['password'] ?? ''?>" placeholder="Your password">
                        </div>
                        <div>
                            <label for="confirmPassword">Comfirm password <b class="text-danger">* </b><span class="text-danger"><?=$errors['confirmPassword'] ?? '' ?></span></label>
                            <input type="password" name="confirmPassword" value="<?=$_POST['confirmPassword'] ?? ''?>" placeholder="Confirm password">
                        </div>
                        <div class="createAcctBtn mt-4"><input type="submit" name="addNewUser" class="btn rounded-1" value="Create your account"></div>
                    </form>
                </div>
            </div>
        </aside>

    </section>
</body>
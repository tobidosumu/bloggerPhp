<?php include './header/signupHeader.php'?>

<body>
    <section class="d-flex">

        <aside id="leftAside">
            <h2>Welcome to Blogger</h2>
        </aside>

        <aside id="rightAside">
            <div class="header d-flex justify-content-end align-items-center">
                <a href="#">Don't have an account?</a>
                <a class="btn rounded-1" href="#">Log in</a>
            </div>
            <div class="formWrapper d-flex flex-column">
                <div class="formContents d-flex flex-column">
                    <h2 class="pt-5 pb-4">Create your free account</h2>
                    <form action="../classes/signup.insert.php" method="post">
                        <div>
                            <label for="fname">First name</label>
                            <input type="text" name="firstName" placeholder="Your first name" id="">
                        </div>
                        <div>
                            <label for="lname">Last name</label>
                            <input type="text" name="lastName" placeholder="Your last name" id="">
                        </div>
                        <div>
                            <label for="address">Email</label>
                            <input type="text" name="address" placeholder="Your email address" id="">
                        </div>
                        <div>
                            <label for="address">Password</label>
                            <input type="text" name="password" placeholder="Your password" id="">
                        </div>
                        <div>
                            <label for="address">Password</label>
                            <input type="text" name="confirmPassword" placeholder="Confirm password" id="">
                        </div>
                        <div class="createAcctBtn mt-2"><input type="submit" name="addNewUser" class="btn rounded-1" value="Create your account"></div>
                    </form>
                </div>
            </div>
        </aside>

    </section>
</body>
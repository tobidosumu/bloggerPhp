<?php 

    // Start the session
    session_start();

    $userLoggedIn = '';
    $userLoggedInViewContents = '';

    require './classes/dbConnect.php'; // DbConnect
    require './classes/user.dbQuery.php'; // UserDbQuer 

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) 
    {
        // User is logged in
        $userLoggedIn = true;

        $user = new UserDbQuery();
        $userData = $user->fetchOne();

        if (isset($_POST['logOutUser'])) 
        {
            // User is logged in
            $userStatus = new UserSessionValidator();
            $logOutUser = $userStatus->logOutUser();
        }
    } 
    else 
    {
        // User is not logged in
        $userLoggedIn = false;
        $userLoggedInViewContents = true; // Do not display post contents to a user who is not logged in
    }

?>

<body>
    <div class="mainContainer"> <!-- contains all the page contents -->
        
        <?php include $userLoggedIn ? './headers/cartHeader.php' : './headers/notLoggedInCartHeader.php'; ?>

        <section class="hero border-bottom">

            <section class="caption">

                <?php if ($userLoggedInViewContents):?> <!--  Do not display post contents to a user who is not logged in -->
                        
                    <div class="notLoggedIndashboardView mb-3 d-flex justify-content-around flex-column">
                        <div class="d-flex justify-content-around">
                            <a href="./login.php" class="actionBtn rounded-1">Cart</a> 
                            <!-- <i class="bi bi-send"></i> -->
                        </div>
                        <p class="m-auto mt-3">Sign up or Login to see all your posts and posts you've liked.</p>
                    </div>

                    <?php else: ?>

                    <div class="dashboardView d-flex justify-content-center align-items-center"> <!--- Signed in Dashboard -->
                        <div class="userProfile d-flex flex-column align-items-center">
                            <div class="userProfileAvatar d-flex justify-content-between align-items-center">
                                <img src="./assets/images/moji.png" alt="user avatar">
                                <p class="likeCount p-1 pt-2 px-2"><i class="bi bi-heart-fill"></i> 1.4M</p>
                            </div>
                            <p class="mt-2">Mojisola Badmus</p>
                            <div class="userProfileInfo d-flex justify-content-between">
                                <p>Followers 214</p>
                                <i class="bi bi-dot"></i>
                                <p>Email: moji@gmail.com</p>
                            </div>
                        </div>
                    </div>

                <?php endif; ?> 

            </section>

        </section>

        <section class="blogContents pt-5">
            
            <section class="blogContentContainer"> <!-- blog contents container starts here -->

                <section class="blogPostContainer">
         
                </section>

            </section>

            <section class="dropUsAmessage mb-5 p-5 rounded-2">
                <div>
                    <h2 class="h5 mb-3">Drop us a line!</h2>
                </div>
                <div class="textBlockContainer d-flex justify-content-between align-items-start">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo
                        atque minus qui assumenda atque minus qui assumenda atque minus qui assumenda atque minus qui assumenda
                    </p>
                    <a href="mailto:imtobidosunmu@gmail.com" class="btn">Contact us</a>
                </div>
            </section>

        </section>

        <footer class="d-flex justify-content-between py-5"> <!-- footer -->

            <div class="contactUs">
                <ul class="d-flex flex-column">
                    <p>Contact us</p>
                    <li><a href="#">Blogger.com</a></li>
                    <li><a href="tel:+2348081659995">+2348 081 659 995</a></li>
                </ul>
            </div>

            <div class="links justify-content-center">
                <ul class="d-flex flex-column">
                    <p>Links</p>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">Resources</a></li>
                </ul>
            </div>

            <div class="products justify-content-center">
                <ul class="d-flex flex-column">
                    <p>Products</p>
                    <li><a href="#">Blogger Social</a></li>
                    <li><a href="#">Blogger Media</a></li>
                    <li><a href="#">Blogger Times</a></li>
                </ul>
            </div>

            <div class="followUs justify-content-end">
                <ul class="d-flex flex-column align-items-start">
                    <p>Follow us</p>
                    <li>
                        <ul>
                            <li><a href="#"><img src="./assets/svg/pinterestIcon.svg" alt="follow us on Facebook"></a></li>
                            <li><a href="#"><img src="./assets/svg/youtubeIcon.svg" alt="follow us on Youtube"></a></li>
                            <li><a href="#"><img src="./assets/svg/facebookIcon.svg" alt="follow us on Facebook"></a></li>
                            <li><a href="#"><img src="./assets/svg/twitterIcon.svg" alt="follow us on Twitter"></a></li>
                        </ul>
                    </li>
                    <li class="logoList mt-3"><a href="#"><img src="./assets/svg/bloggerLogoWhite.svg" alt="Blogger.com"></a></li>
                </ul>
            </div>

        </footer>

    </div>
</body>

</html>
<?php

    session_start();

    $userLoggedIn = '';

    require './classes/dbConnect.php'; // DbConnect
    require './classes/post.queryDb.php'; // PostDbConnector
    require './classes/post.validator.php'; // PostValidator
    require './classes/userSession.validator.php'; // UserSession 

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) 
    {
        $userLoggedIn = true;
            
        if (isset($_POST['logOutUser'])) 
        {
            $userStatus = new UserSessionValidator();
            $logOutUser = $userStatus->logOutUser();
        } 
    } 
    else 
    {
        $userLoggedIn = false;
    }

?>

<body>
    <div class="mainContainer"> <!-- contains all the page contents -->

        <?php include $userLoggedIn ? './headers/postDetailsHeader.php' : './headers/notLoggedInPostDetailsHeader.php'; ?>

        <section class="blogContents">
            
            <section class="d-flex justify-content-between">

                <section class="mainContentContainer border-end"> <!-- blog contents container starts here -->
                    <nav class="my-3">
                        <ul class="d-flex">
                            <li><a href="./posts.php">Posts</a></li>
                            <li class="mx-2"><i class="bi bi-chevron-right"></i></li>
                            <li><a href="/">Post Details</a></li>
                        </ul>
                    </nav>
                    
                    <?php

                        if (isset($_GET['id'])):

                        $postData = new PostQueryDb();
                        $postData->setPostId($_GET['id']);
                        $postDetail = $postData->fetchOnePost();

                    ?>
                    
                        <div class="innerContainer"> <!-- photo and title container -->
                            <div class="postImage"> <!-- image div -->
                                <img class="img-fluid w-100" src="<?= $postDetail['photo'] ?>"> <!-- displays post photo -->   
                                <p class="px-1"><i class="bi bi-clock"></i> <?php 
                                    $post = new PostValidator();
                                    $created_at = $postDetail['created_at'];
                                    $time = strtotime($created_at);
                                    $post->setTimeAgo($time);
                                    $timeAgo = $post->getTimeAgo();
                                    echo $timeAgo;
                                    ?>
                                </p>
                            </div>

                            <!-- icons -->
                            <div class="rightIconsDiv d-flex flex-column justify-content-between">
                                <div class="likes">
                                    
                                    <i id="heart-icon" class="bi bi-heart" onclick="replaceLikeIcon(this)"></i>

                                    <p>221.9k</p>
                                </div>
                                <div class="comments">
                                    <a href="#scrollspyAboutMe"><i class="bi bi-chat-square"></i></a>
                                    <!-- <i class="bi bi-chat-square"></i> -->
                                    <p>1907</p>
                                </div>
                                <div class="shares">
                                    <i class="bi bi-reply"></i>
                                    <p>1805</p>
                                </div>
                            </div>

                            <div class="categoryTitleContainer"> <!-- title, category container -->
                                <div class="categoryReadTimeContainer d-flex justify-content-between p-2"> <!-- category and read time div -->
                                    <h5><?=$postDetail['categoryName']?></h5> 
                                    <h6> 

                                        <?php
                                            $totalNumWords = str_word_count($postDetail['description'], 0);
                                            $wpm = 200; // where "wpm" is number of words per minute.  
                                            $readPerMinute = floor($totalNumWords / $wpm); 
                                            print_r("$readPerMinute Min Read");
                                        ?> 

                                    </h6>
                                </div>
                                <div class="titleContainer"> <!-- title div -->
                                    <h4 class="pt-0 pe-3"><?=$postDetail['title']?></h4>
                                </div> 
                            </div>

                            <div class="postDescription">
                                <p><?=$postDetail['description']?></p>
                            </div>

                            <div id="scrollspyAboutMe" class="commentSection pt-3">
                                
                                <!-- Post details icons -->
                                <div class="iconsWrapper d-flex justify-content-between my-4">
                                    <div class="likes d-flex flex-column align-items-center">
                                    
                                        <i id="heart-icon" class="bi bi-heart" onclick="replaceLikeIcon(this)"></i>

                                        <p>221.9k</p>
                                    </div>
                                    <div class="comments d-flex flex-column align-items-center">
                                        <i class="bi bi-chat-square"></i>
                                        <p>1907</p>
                                    </div>
                                    <div class="shares d-flex flex-column align-items-center">
                                        <i class="bi bi-reply"></i>
                                        <p>1805</p>
                                    </div>
                                </div>

                                <!-- User comment -->
                                <div class="userComment d-flex mb-4 p-3">
                                    <div class="userAvatar">
                                        <a href="#">
                                            <img src="./assets/images/moji.png" alt="user avatar">
                                        </a>
                                    </div>
                                    <div class="commentContainer">
                                        <div class="userStats d-flex align-items-center">
                                            <h6>mojisola badmus <span>· 2 hours ago</span></h6>
                                        </div>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                                            Reprehenderit eum veritatis illo magni iure, aliquam, quam 
                                            doloribus nobis ipsam culpa. 
                                        </p>
                                    </div>
                                </div>

                                <div class="commentWrapper mt-5">
                                    <textarea name="comment" id="expandable-textarea" placeholder="Add a comment..."></textarea>
                                </div>
                                
                            </div>
                        </div>
                                
                    <?php endif ?>

                </section>

                <aside class="rightSideContentContainer d-flex flex-column align-items-center pt-4 ps-2"> <!-- products section start here -->
                    <a href="#" class="captionCard d-flex align-items-center justify-content-between px-2 border"><!-- captionCard link -->
                        <i class="bi bi-shop-window p-1 rounded-1"></i>
                        <h4>Unusual Merch Store</h4>
                        <i class="bi bi-arrow-up-right-square"></i>
                    </a>           

                    <div class="productCard mt-3 border">
                        <a href="#" class="d-flex flex-column align-items-center p-2"> <!-- product image link -->
                            <div class="productImage">
                                <img class="img-fluid" src="./assets/images/addidas.webp" alt="">
                            </div> 
                            <div class="productContent">
                                <h2 class="py-2">ADIDAS VS PACE LIFESTYLE</h2>
                                <h2 class="pb-2">₦ 29,978</h2>
                                <div class="addToCart">
                                    <button class="rounded-1" type="submit"><i class="bi bi-bag-plus me-1"></i> Add to cart</button>
                                </div>
                            </div>
                        </a>
                    </div>

                </aside>

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
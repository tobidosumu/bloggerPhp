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
                            <li>Post Details</li>
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
                                <div class="categoryReadTimeContainer d-flex justify-content-between p-2 px-3"> <!-- category and read time div -->
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

            <?php include './footers/dropUsAMessage.php' ?>

        </section>

        <?php include './footers/globalFooter.php' ?>

    </div>
</body>

</html>
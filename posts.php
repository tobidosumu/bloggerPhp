<?php 

    // Start the session
    session_start();

    $userLoggedIn = '';
    $userLoggedInViewContents = '';

    require './classes/dbConnect.php'; // DbConnect
    require './classes/post.queryDb.php'; // PostDbConnector
    require './classes/post.validator.php'; // PostValidator
    require './classes/userSession.validator.php'; // UserSession 
    require './classes/user.dbQuery.php'; // UserDbQuer 

    if (isset($_POST['savePostData'])) 
    {
        $validatePostData = new PostValidator();
        $validatePostData->setTitle($_POST['title']);
        $validatePostData->setCategory($_POST['category']);
        $validatePostData->setDescription($_POST['description']);
        $validatePostData->setFileName($_FILES['photo']['name']);
        $validatePostData->setFileSize($_FILES['photo']['size']);
        $validatePostData->setFileError($_FILES['photo']['error']);

        $errors = $validatePostData->validatePostData();

        if (!$errors)
        {
            $dbQuery = new PostQueryDb();
            $dbQuery->setTitle($_POST['title']);
            $dbQuery->setCategory($_POST['category']);
            $dbQuery->setDescription($_POST['description']);
            
            $savedPostData = $dbQuery->insertPost();

            
        }

    }

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
        
        <?php include $userLoggedIn ? './headers/postsHeader.php' : './headers/notLoggedInPostsHeader.php'; ?>

        <section class="hero border-bottom">

            <section class="caption">

                <?php if ($userLoggedInViewContents):?> <!--  Do not display post contents to a user who is not logged in -->
                        
                    <div class="notLoggedIndashboardView">
                        <div class="d-flex justify-content-evenly">
                            <a href="./signup.php" class="actionBtn rounded-1">Sign up</a> 
                            <a href="./login.php" class="actionBtn rounded-1">Login</a> 
                        </div>
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
                    <?php 
                        if ($userLoggedInViewContents):?> <!--  Do not display post contents to a user who is not logged in -->
                            <div class="m-auto pt-5"> 
                                <p class="m-auto mt-3">Sign up or Login to see all your posts and posts you've liked.</p>
                            </div>
                        <?php else:
                    
                        $dbQuery = new PostQueryDb();
                        $allPostData = $dbQuery->fetchAllPosts();

                        $validatePostData = new PostQueryDb();

                        foreach ($allPostData as $postData): ?>
                            <div class="postCard border rounded-top rounded-3 pb-1">

                                <!-- blog post card starts here -->
                                <div class="postPhoto rounded-top">

                                    <div class="upperInfo d-flex justify-content-between px-2">
                                        <h5 class="postTime">
                                            <?php 
                                                $post = new PostValidator();
                                                $created_at = $postData['created_at'];
                                                $time = strtotime($created_at);
                                                $post->setTimeAgo($time);
                                                $timeAgo = $post->getTimeAgo();
                                                echo $timeAgo;
                                            ?>
                                        </h5>
                                        <div class="moreInfo ms-3"><i class="bi bi-three-dots-vertical"></i></div> 
                                    </div>
                                    <div class="rightSideInfo d-flex flex-column align-items-end pt-2 pe-2 mb-5">
                                        <div class="iconDiv mb-2"><i id="heart-icon" class="bi bi-heart" onclick="replaceLikeIcon(this)"></i></div>    
                                    </div>
                                    
                                    <a href="./postDetails.php?id=<?=$postData['post_id']?>">
                                        <img class="img-fluid rounded-top" src="<?=$postData['photo']?>"> <!-- fetches photo -->
                                    </a>

                                </div>

                                <div class="postCategory d-flex justify-content-between py-2 px-2">
                                    <p><?=$postData['categoryName'] ?></p> <!-- fetches categoryName -->

                                    <p>
                                        <?php
                                            $totalNumWords = str_word_count($postData['description'], 0);
                                            $wpm = 200; // where "wpm" is number of words per minute.  
                                            $readPerMinute = floor($totalNumWords / $wpm); 
                                            $readTime = $readPerMinute. ' Min read'; 
                                            print_r($readTime);
                                        ?>
                                    </p>

                                </div>

                                <div class="postTitle px-2 mt-4">
                                    <h6><?=substr_replace($postData['title'],  "...", 55)?></h6> <!-- fetches title from db -->
                                </div>
                                <div class="postParagraph px-2">
                                    <p><?=substr_replace($postData['description'], "...", 70)?></p> <!-- fetches description -->
                                </div>
                            </div>
                    <?php 
                        endforeach; 
                        endif; 
                    ?>            
                </section>

            </section>

            <?php include './footers/dropUsAMessage.php' ?>

        </section>

        <?php include './footers/globalFooter.php' ?>

    </div>
</body>

</html>
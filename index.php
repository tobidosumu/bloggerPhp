<?php

session_start(); // Start the session

$userLoggedIn = '';

require './classes/dbConnect.php'; // DbConnect
require './classes/post.queryDb.php'; // PostDbConnector
require './classes/post.validator.php'; // PostValidator
require './classes/category.validator.php'; // CategoryValidator
require './classes/userSession.validator.php'; // UserSession 
require './classes/user.dbQuery.php'; // UserDbQuery

if (isset($_POST['insertPostData'])) 
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
        $insertPostData = new PostQueryDb();
        $insertPostData->setTitle($_POST['title']);
        $insertPostData->setCategory($_POST['category']);
        $insertPostData->setDescription($_POST['description']);

        $insertPostData->insertPost();

        $_POST = []; 
    } 
} 

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
    $userLoggedIn = false; // User is not logged in
}

?>

<body>

    <div class="mainContainer"><!-- contains all the page contents -->

        <?php include $userLoggedIn ? './headers/indexHeader.php' : './headers/notLoggedInIndexHeader.php'; ?>

        <section class="blogContents">

            <section class="d-flex justify-content-between">

                <section class="mainContentContainer">

                    <?php 
                    
                        $postResults = new PostQueryDb();
                        $posts = $postResults->fetchAllPosts();

                        foreach ($posts as $post): ?>
                    
                        <div class="postCard border rounded-top rounded-2">

                            <div class="postHeader">
                                <div class="userAvater">
                                    <img src="assets/images/moji.png" alt="">

                                    <?php 
                                        $userNamesResult = new UserDbQuery();
                                        $userNames = $userNamesResult->getFullNames();

                                        foreach ($userNames as $userName): ?>
                                    
                                        <p class="avaterDetails ms-3"> <?= $userName['firstName'] . ' '.  $userName['lastName'] ?> </p>
                                    
                                    <?php endforeach ?>

                                </div>
                                
                                <div class="postInfo">

                                    <?php 
                                        $rawPostTime = $post['created_at'];
                                        $postTime = strtotime($rawPostTime);
                                        $formatPostTime = new PostValidator();
                                        $formattedPostTime = $formatPostTime->setTimeAgo($postTime);
                                        $formattedPostTime = $formatPostTime->getTimeAgo();
                                        // var_dump($formattedPostTime);
                                    ?>

                                    <p><?= $formattedPostTime ?></p>

                                    <i class="bi bi-three-dots-vertical" data-bs-toggle="modal" data-bs-target="#moreInfoModal"></i>
                                    
                                    <div class="moreInfoModal modal fade" id="moreInfoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-body d-flex flex-column justify-content-center align-items-center text-center">

                                                    <form action="" method="post"> <!-- post header three dots popup modal -->
                                                        <button type="submit" name="deletePost"><li class="nthChild rounded-top">Delete post</li></button>
                                                        <a href="#"><li class="nthChild">Edit post</li></a>
                                                        <!-- <a href="./postDetails.php?id="><li>Go to post</li></a> -->
                                                        <a href="#"><li>Add to favorites</li></a>
                                                        <a href="#"><li>Share to</li></a>
                                                        <a href="#"><li>Copy link</li></a>
                                                        <a href="#" data-bs-dismiss="modal"><li class="lastChild rounded-bottom">Cancel</li></a>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="postPhoto">
                                <a href="./postDetails.php?id=<?= $post['post_id'] ?>">
                                    <img class="img-fluid" src="<?= $post['photo'] ?>"> <!-- fetches post photo -->
                                </a>
                                <div class="postIconsContainer d-flex justify-content-end">
                                    <div class="rightIconsDiv d-flex flex-column justify-content-between align-items-center">
                                        <div class="likes">
                                            
                                            <i id="heart-icon" class="bi bi-heart" onclick="replaceLikeIcon(this)"></i>
                                            <p>221.9k</p>

                                        </div>
                                        <div class="comments">
                                            <i class="bi bi-chat-square"></i>
                                            <p>1907</p>
                                        </div>
                                        <div class="shares">
                                            <i class="bi bi-reply"></i>
                                            <p>1805</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="postTextWrapper">

                                <p class="postCategory"> <?= $post['categoryName'] ?> </p>

                                <p class="postParagraph"> <?= $post['title'] ?> </p>

                                <!-- <p class="commentsCount">View all 142 comments</p> -->
                            </div>

                            <div class="postCommentWrapper d-flex align-items-center align-items-center">
                                <div class="emojiWrapper">
                                    <i class="bi bi-emoji-smile"></i>
                                </div>

                                <div class="commentWrapper">
                                    <textarea name="comment" onclick="autoResizeTextarea()" id="expandable-textarea" placeholder="Add a comment..."></textarea>
                                </div>

                                <div class="postBtnWrapper d-flex justify-content-end">
                                    <button id="postBtnWrapper" type="submit">Post</button>
                                </div>
                            </div>

                        </div>

                    <?php endforeach ?>    
                 
                </section>

                <aside class="rightSideContentContainer border-start">
                    
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

        <footer class="d-flex justify-content-between py-5">

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
                            <li><a href="#"><img src="assets/svg/pinterestIcon.svg" alt="follow us on Facebook"></a></li>
                            <li><a href="#"><img src="assets/svg/youtubeIcon.svg" alt="follow us on Youtube"></a></li>
                            <li><a href="#"><img src="assets/svg/facebookIcon.svg" alt="follow us on Facebook"></a></li>
                            <li><a href="#"><img src="assets/svg/twitterIcon.svg" alt="follow us on Twitter"></a></li>
                        </ul>
                    </li>
                    <li class="logoList mt-3"><a href="#"><img src="assets/svg/bloggerLogoWhite.svg" alt="Blogger.com"></a></li>
                </ul>
            </div>

        </footer>
        
        <!-- This button triggers create POST modal -->
        <button type="button" onclick="openPostModal()" class="postBtn border-0">
            <img src="assets/svg/feather.svg" alt="Click to post">
        </button>
        
        <div id="createPostTooltip" class="createPostTooltip">
            <p>Click to post</p>
        </div>

        <?php include './modals/createModal.php'?>

    </div>

    <div id="postModalBackground" onclick="closePostModal()" class="postModalBackground"> </div>

</body>

</html>

<?php if (!empty($errors)): ?>
    <script defer>
        $(document).ready(function(){
            openPostModal();
        });
    </script>
<?php endif ?>
<?php
// Start the session
session_start();

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

        header("Location: ".$_SERVER['PHP_SELF']);
    } 
} 

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) 
{
    // User is logged in
    $userLoggedIn = true;   
    
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
        <button type="button" class="postBtn border-0" data-bs-toggle="modal" data-bs-target="#postModal">
            <img src="assets/svg/feather.svg" alt="Click to post">
        </button>
        
        <div id="createPostTooltip" class="createPostTooltip">
            <p>Click to post</p>
        </div>

        <!-- Create POST Modal -->
        <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content modalContent">

                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body px-4 my-2">

                            <label for="title">Blog title<b class="text-danger"> * </b><span class="text-danger"><?= $errors['title'] ?? '' ?></span></label> <!-- Blog title starts here -->
                            <div class="input-group mt-2 mb-3">
                                <span class="input-group-text" id="addon-wrapping">
                                    <i class="bi bi-card-heading"></i>
                                </span>
                                <input type="text" class="form-control py-2" name="title" value="<?= $_POST['title'] ?? '' ?>" placeholder="Add blog title">
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <label for="title" class="mt-3">Blog category<b class="text-danger"> * </b><span class="text-danger"><?= $errors['category'] ?? '' ?></span></label> <!-- Blog category starts here -->
                                <span><a href="./categories.php" target="_blank" class="addCatBtn btn btn-sm btn-outline-primary">Add category <i class="bi bi-box-arrow-up-right ms-1"></i></a></span>
                            </div>

                            <div class="input-group mt-2 mb-3">

                                <span class="input-group-text rounded-0 rounded-start border-end-0" id="addon-wrapping">
                                    <i class="bi bi-list"></i>
                                </span>

                                <select class="form-select py-2" name="category" id="floatingSelect" aria-label="Floating label select example">
                                    
                                    <option>Select a category</option>
                                    
                                    <?php
                                        $result = new CategoryQueryDb();
                                        $categories = $result->fetchAllCategoryNames();
                                        foreach ($categories as $category) {
                                        
                                        $selected = "";
                                        if (isset($_POST['category']) && $_POST['category'] == $category['categoryName']) {
                                            $selected = "selected";
                                        }
                                        
                                        ?>
                                        <option value="<?= $category['id'] ?>" <?= $selected ?>><?= $category['categoryName'] ?></option> 
                                        
                                    <?php
                                    }
                                    ?>
                                    
                                </select>

                            </div>

                            <label for="title">Blog description<b class="text-danger"> * </b><span class="text-danger"><?= $errors['description'] ?? '' ?></span></label> <!-- blog description starts here-->
                            
                            <div class="input-group mt-2 mb-3">

                                <span class="input-group-text rounded-0 rounded-start border-end-0" id="addon-wrapping">
                                    <i class="bi bi-pencil-square"></i>
                                </span>
                                <textarea class="form-control rounded-0 rounded-end decriptionField" name="description" placeholder="Add blog description" id="floatingTextarea2" style="height: 100px"><?= $_POST['description'] ?? '' ?></textarea>
                            </div>

                            <label for="title">Blog photo<b class="text-danger"> * </b><span class="text-danger"><?= $errors['photo'] ?? '' ?></span></label> <!-- upload blog photo starts here-->
                            <div class="input-group mt-2 mb-3">
                                <span class="input-group-text rounded-0 rounded-start border-end-0" id="addon-wrapping">
                                    <i class="bi bi-card-image"></i>
                                </span>
                                <input type="file" name="photo" value="<?= $_POST['photo'] ?? '' ?>" class="form-control" id="inputGroupSelect01" aria-describedby="inputGroupFileAddon01" aria-label="Upload">
                            </div>

                        </div> <!-- modal body ends here -->

                        <div class="modal-footer">
                            <button type="submit" name="insertPostData" class="sendPostBtn btn btn-primary">Post <i class="bi bi-send"></i></button>
                        </div>

                    </form> <!-- form ends here -->

                </div>

            </div>

        </div>

    </div>
    
</body>

</html>
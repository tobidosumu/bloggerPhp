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
                    
                        <?php include './cards/postCard.php' ?>

                    <?php endforeach ?>    
                 
                </section>

                <aside class="rightSideContentContainer border-start"> </aside>

            </section>

            <?php include './footers/dropUsAMessage.php' ?>

        </section>

        <?php include './footers/globalFooter.php' ?> <!-- Footer -->
        
        <!-- Create Post Modal button -->
        <button type="button" onclick="openPostModal()" class="postBtn border-0">
            <img src="assets/svg/feather.svg" alt="Click to post">
        </button>
        
        <div id="createPostTooltip" class="createPostTooltip">
            <p>Click to post</p>
        </div>

        <?php include './modals/createPostModal.php'?>

    </div>

    <!-- Black background behind Post Modal -->
    <div id="postModalBackground" onclick="closePostModal()" class="postModalBackground"> </div>

</body>

</html>

<?php if (!empty($errors)): ?> <!-- Keeps Create Post Modal open when there is error after form submission -->
    <script defer>
        $(document).ready(function(){
            openPostModal();
        });
    </script>
<?php endif ?>
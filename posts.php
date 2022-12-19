<?php 
    require './classes/dbConnect.php'; // DbConnect
    require './classes/post.queryDb.php'; // PostDbConnector
    require './classes/post.validator.php'; // PostValidator

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
            
            $savedPostData = $dbQuery->savePostData();

        }
        else
        {
            print_r(
                '<div class="myAlert position-absolute mt-5 start-50 translate-middle alert bg-danger text-light d-flex align-items-center" role="alert">
                    <div>
                        <i class="bi bi-emoji-frown"></i>
                        Error occurred! Please check the form and try again.
                    </div>
                </div>'
            );
            header('Refresh:3; url=main.php');
        }
    }

?>

<body>
    <div class="mainContainer"> <!-- contains all the page contents -->
        
        <?php include './headers/postsHeader.php'?> <!-- header goes here -->

        <section class="hero border-bottom">
            <section class="caption">
                <div>
                    <tertiaryFont class="mb-3">View All Your Posts <i class="bi bi-send"></i></tertiaryFont>
                    <p>Hello Mojisola Badmus
                    </p>
                </div>
            </section>
        </section>

        <section class="blogContents pt-5">
            
            <section class="blogContentContainer"> <!-- blog contents container starts here -->

                <section class="blogPostContainer">

                    <?php
                        $dbQuery = new PostQueryDb();
                        $allPostData = $dbQuery->fetchAll();

                        $validatePostData = new PostQueryDb();

                        foreach ($allPostData as $postData)
                        {
                            ?>
                                <div class="postCard border rounded-top rounded-3 pb-1">
                                    <a href="./postDetails.php?id=<?=$postData['id']?>">
                                        <!-- blog post card starts here -->
                                        <div class="postPhoto rounded-top">
                                            <img class="img-fluid rounded-top" src="http://localhost/mrEnitan/projects/blog/<?=$postData['photo']?>"> <!-- fetches photo from blog_post table -->
                                            <div class="upperInfo d-flex pt-2 pe-2">
                                                <h5 class="postTime m-auto">2 sec ago</h5>
                                                <div class="moreInfo ms-3"><i class="bi bi-three-dots-vertical"></i></div> 
                                            </div>

                                            <div class="lowerInfo d-flex flex-column align-items-end pt-2 pe-2 mb-5">
                                                <div class="mb-2"><i class="bi bi-heart"></i></div>    
                                                <div><i class="bi bi-chat-square"></i></div>    
                                            </div>
                                        </div>
                                        <div class="postCategory d-flex justify-content-between py-2 px-2">
                                            <p><?=$postData['category'] ?></p> <!-- fetches category from db -->

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
                                            <p><?=substr_replace($postData['description'], "...", 70)?></p> <!-- fetches description from db -->
                                        </div>
                                    </a>
                                </div>
                            <?php    
                        }
                    ?>
                </section>

                <nav aria-label="..." class="d-flex justify-content-center mt-5 pt-5 border-top">
                    <!-- pagination -->
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </section>

            <section class="dropUsAmessage mb-5 p-5 rounded-2">
                <div>
                    <h2 class="h5 mb-3">Drop us a line!</h2>
                </div>
                <div class="textBlockContainer d-flex justify-content-between align-items-start">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo
                        atque minus qui assumenda atque minus qui assumenda atque minus qui assumenda atque minus qui assumenda
                    </p>
                    <a href="#" class="btn">Contact us</a>
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
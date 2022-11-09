<?php
    require './classes/dbConnect.php'; // DbConnect
    require './classes/post.queryDb.php'; // PostDbConnector
    require './classes/post.validator.php'; // PostValidator
?>

<body>
    <div class="mainContainer"> <!-- contains all the page contents -->

        <?php include './header/postDetailsHeader.php'?> <!-- header goes here -->

        <section class="blogContents"> 
            
            <section class="d-flex justify-content-between">

                <section class="mainContentContainer border-end"> <!-- blog contents container starts here -->

                    <?php

                        if (isset($_GET['id'])) 
                        {
                            $id = $_GET['id'];

                            $dbQuery = new PostQueryDb();
                            $postDetail = $dbQuery->fetchOne($id);
                            ?>
                                <div class="innerContainer wrap"> <!-- photo and title container -->
                                    <div class="postImage"> <!-- image div -->
                                        <img class="img-fluid w-100" src="http://localhost/mrEnitan/projects/blog/<?=$postDetail['photo']?>"> <!-- fetches photo from blog_post table -->   
                                    </div>
                                    <div class="categoryTitleContainer"> <!-- title, category container -->
                                        <div class="categoryReadTimeContainer d-flex justify-content-between p-2 pb-0"> <!-- category and read time div -->
                                            <h5><?=$postDetail['category']?></h5> 
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
                                            <h4 class="p-2 pt-0"><?=$postDetail['title']?></h4>
                                        </div> 
                                    </div>

                                    <div class="postDescription">
                                        <p><?=$postDetail['description']?></p>
                                    </div>
                                </div>
                                
                            <?php
                        }
                        else
                        {
                            print_r(
                                '<div class="myAlert position-absolute mt-5 start-50 translate-middle alert bg-danger text-light d-flex align-items-center" role="alert">
                                    <div>
                                        <i class="bi bi-emoji-frown"></i>
                                        Stop wasting your time.
                                    </div>
                                </div>'
                            );
                        }
                    ?>

                </section>

                <aside class="rightSideContentContainer mt-4 ps-2"> <!-- products section start here -->
                    <a href="#">
                        <div class="captionCard d-flex align-items-center justify-content-between px-2 border">

                            <i class="bi bi-shop-window p-1 rounded-1"></i>
                            <h4>Unusual Merch Store</h4>
                            <i class="bi bi-arrow-up-right-square"></i>
                        </div>
                    </a>           
                    
                    <a href="#">
                        <div class="productCard mt-3 border">
                            <div class="productImage">
                                <img class="img-fluid" src="./assets/images/addidas.webp" alt="">
                            </div>
                        </div>
                    </a>
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
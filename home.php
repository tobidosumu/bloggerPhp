<?php
    require './classes/dbConnect.php'; // DbConnect
    require './classes/post.queryDb.php'; // PostDbConnector
    require './classes/post.validator.php'; // PostValidator
?>

<body>
    <div class="mainContainer"> <!-- contains all the page contents -->

        <?php include './header/homeHeader.php'?> <!-- header goes here -->

        <section class="blogContents"> 
            
            <section class="d-flex justify-content-between">

                <section class="mainContentContainer"> <!-- blog contents container starts here -->
                        
                    <?php
                        $dbQuery = new PostQueryDb();
                        $allPostData = $dbQuery->fetchAll();

                        $validatePostData = new PostQueryDb();

                        foreach ($allPostData as $postData)
                        {
                            ?>
                                <div class="postCard border rounded-top rounded-2">
                                    <!-- <a href="./postDetails.php?id=<?=$postData['id']?>"> -->
                                        <!-- blog post card starts here -->
                                        <div class="postHeader">
                                            <div class="userAvater">
                                                <img src="./assets/images/moji.png" alt="">
                                                <div class="avaterDetails ms-3">
                                                    <p>Mojisola Badmus</p>
                                                </div>
                                            </div>
                                            <div class="postInfo">
                                                <p>2 sec ago</p>
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </div>
                                        </div>

                                        <div class="postPhoto">
                                            <a href="./postDetails.php?id=<?=$postData['id']?>">
                                                <img class="img-fluid" src="http://localhost/mrEnitan/projects/blog/<?=$postData['photo']?>"> <!-- fetches photo from blog_post table -->
                                            </a>
                                            <div class="postCategory d-flex justify-content-end">
                                                <div class="rightIconsDiv d-flex flex-column justify-content-between align-items-end">
                                                    <div class="likes">
                                                        <i class="bi bi-heart"></i>
                                                        <p>221.9k</p>
                                                    </div>
                                                    <div class="comments">
                                                        <i class="bi bi-chat-square"></i>
                                                        <p>1907</p>
                                                    </div>
                                                    <div class="shares">
                                                        <i class="bi bi-share"></i>
                                                        <p>1805</p>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                        
                                        <div class="postTextWrapper">
                                            <!-- <p class="likesCount">16,474 likes</p> -->
                                            <div class="postTitle">
                                                <p><?=$postData['category'] ?></p>
                                            </div>
                                            <div class="postParagraph">
                                                <p><?=substr_replace($postData['description'], "... <span>more</span>", 60)?></p> <!-- fetches description from db -->
                                            </div>
    
                                            <p class="commentsCount">View all 142 comments</p>
                                        </div>
                                        
                                        <div class="postCommentWrapper d-flex align-items-center align-items-center">
                                            <div class="emojiWrapper">
                                                <i class="bi bi-emoji-smile"></i>
                                            </div>

                                            <div class="commentWrapper">
                                                <textarea name="comment" placeholder="Add a comment..."></textarea>
                                            </div>

                                            <div class="postBtnWrapper d-flex justify-content-end">
                                                <button type="submit">Post</button>
                                            </div>
                                        </div>
                                        
                                    <!-- </a> -->
                                </div>
                            <?php    
                        }
                    ?>
                
                </section>

                <aside class="rightSideContentContainer mt-4 ps-2"> <!-- products section start here -->
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
                                <h2 class="py-2">Adidas vs pace lifestyle</h2>
                                <h2 class="pb-2">₦ 29,978</h2>
                                <div class="addToCart">
                                    <button class="rounded-1" type="submit"><i class="bi bi-bag-plus"></i> Add to cart</button>
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
<?php 
    include './header/indexHeader.php';

    require './classes/dbConnect.php'; // DbConnect
    require './classes/post.queryDb.php'; // PostDbConnector
    require './classes/post.validator.php'; // PostValidator

    if (isset($_POST['savePostData'])) 
    {
        $validatePostData = new PostValidator($_POST);
        $errors = $validatePostData->validatePostData();

        if (!$errors)
        {
            $dbQuery = new PostQueryDb($_POST);
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
        }
    }

?>

<body>
    <div class="mainContainer">
        <!-- contains all the page contents -->
        <header class="d-flex justify-content-between align-items-center sticky-top">
            <div class="logoContainer"><a href="http:#"><img src="./assets/svg/bloggerLogoBlack.svg" alt="blogger logo"></a></div>
            <nav class="headerMenuContainer">
                <ul class="d-flex justify-content-between wrap">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">Resources</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#" class="p-0 border-0">Contact Us</a></li>
                </ul>
            </nav>
        </header>
        <section class="hero pt-2">
            <section class="caption">
                <div>
                    <tertiaryFont class="mb-3">Blog about anything.</tertiaryFont>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem
                        minus sapiente reiciendis, expedita nulla?
                    </p>
                </div>
            </section>
        </section>

        <section class="blogContents mt-5">
            
            <section class="blogContentContainer"> <!-- blog contents container starts here -->
                <nav>
                    <ul class="d-flex justify-content-between">
                        <li><a href="#">All</a></li>
                        <li><a href="#">Discoveries</a></li>
                        <li><a href="#">Travel</a></li>
                        <li><a href="#">Stories</a></li>
                        <li><a href="#">Gardening</a></li>
                        <li><a href="#">Sports</a></li>
                        <li><a href="#">Fitness</a></li>
                        <li><a href="#">Programming</a></li>
                    </ul>
                </nav>

                <section class="blogPostContainer">

                    <?php
                        $dbQuery = new PostQueryDb($_POST);
                        $allPostData = $dbQuery->fetchAll();

                        foreach ($allPostData as $postData)
                        {
                            ?>
                                <div class="postCard border rounded-top rounded-3 pb-1">
                                    <a href="#">
                                        <!-- blog post card starts here -->
                                        <div class="postPhoto rounded-top">
                                            <img class="img-fluid rounded-top" src="http://localhost/mrEnitan/projects/blog/<?=$postData['photo']?>"> <!-- fetches photo from blog_post table -->
                                        </div>
                                        <div class="postCategory d-flex justify-content-between py-2 px-2">
                                            <p><?=$postData['category'] ?></p> <!-- fetches category from db -->

                                            <p><?php
                                                $totalNumWords = str_word_count($postData['description'], 0);
                                                // print_r($totalNumWords);
                                                $wpm = 200; // where "wps" is number of words per minute.  
                                                $readPerMinute = floor($totalNumWords / $wpm); 
                                                // $readPerSecond = floor($totalNumWords % $wpm / ($wpm / 60));
                                                print_r($readPerMinute);
                                            ?> Min Read</p>

                                        </div>
                                        <div class="postTitle px-2 mt-2">
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

        <!-- blog post modal container starts here ###################################################################-->
        <div class="modalContainer">

            <!-- Button trigger modal -->
            <button type="button" class="postBtn border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-pencil-square"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <form action="" method="post" enctype="multipart/form-data"> <!-- form starts here -->

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create a Blog Post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body px-4 my-2"> <!-- modal body starts here -->
                                    
                            <?php
                            
                            ?>
                                <label for="title">Blog title<b class="text-danger"> * </b><span class="text-danger"><?=$errors['title'] ?? ''?></span></label> <!-- Blog title starts here -->
                                <div class="input-group mt-2 mb-3"> 
                                    <span class="input-group-text" id="addon-wrapping">
                                        <i class="bi bi-card-heading"></i>
                                    </span>
                                    <input type="text" class="form-control py-2" name="title" value="<?=$_POST['title'] ?? ''?>" placeholder="Add blog title" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                </div>

                                <label for="title">Blog category<b class="text-danger"> * </b><span class="text-danger"><?=$errors['category'] ?? ''?></span></label> <!-- Blog category starts here -->
                                <div class="input-group mt-2 mb-3">
                                    <span class="input-group-text rounded-0 rounded-start border-end-0" id="addon-wrapping">
                                        <i class="bi bi-list"></i>
                                    </span>
                                    <select class="form-select" name="category" id="floatingSelect" aria-label="Floating label select example">
                                        <option value="">Select a category</option>
                                        <option value="<?=$_POST['gardening'] ?? ''?>gardening">Gardening</option>
                                        <option value="<?=$_POST['travel'] ?? ''?>travel">Travel</option>
                                        <option value="<?=$_POST['fitness'] ?? ''?>fitness">Fitness</option>
                                        <option value="<?=$_POST['stories'] ?? ''?>stories">Stories</option>
                                        <option value="<?=$_POST['discoveries'] ?? ''?>discoveries">Discoveries</option>
                                        <option value="<?=$_POST['sports'] ?? ''?>sports">Sports</option>
                                        <option value="<?=$_POST['programming'] ?? ''?>programming">Programming</option>
                                    </select>
                                </div>

                                <label for="title">Blog description<b class="text-danger"> * </b><span class="text-danger"><?=$errors['description'] ?? ''?></span></label> <!-- blog description starts here-->
                                <div class="input-group mt-2 mb-3"> <!-- description field input -->
                                    <span class="input-group-text rounded-0 rounded-start border-end-0" id="addon-wrapping">
                                        <i class="bi bi-pencil-square"></i>
                                    </span>
                                    <textarea class="form-control rounded-0 rounded-end decriptionField" name="description" value="<?=$_POST['description'] ?? ''?>" placeholder="Add blog description" id="floatingTextarea2" style="height: 100px"></textarea>
                                </div>

                                <label for="title">Blog photo<b class="text-danger"> * </b><span class="text-danger"><?=$errors['photo'] ?? ''?></span></label> <!-- upload blog photo starts here-->
                                <div class="input-group mt-2 mb-3">
                                    <span class="input-group-text rounded-0 rounded-start border-end-0" id="addon-wrapping">
                                        <i class="bi bi-card-image"></i>
                                    </span>
                                    <input type="file" name="photo" value="<?=$_POST['photo'] ?? ''?>" class="form-control" id="inputGroupSelect01" aria-describedby="inputGroupFileAddon01" aria-label="Upload">
                                </div>

                            </div> <!-- modal body ends here -->
                                
                            <div class="modal-footer"> <!-- modal footer -->
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="savePostData" class="btn btn-primary">Save changes</button>
                            </div>

                        </form> <!-- form ends here -->

                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</body>

</html>
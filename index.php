<?php 
    include './header/indexHeader.php';
    require_once './classes/post.validator.php';
?>

<body>
    <div class="mainContainer">
        <!-- contains all the page contents -->
        <section class="hero pt-2">
            <header class="d-flex justify-content-between align-items-center">
                <div class="logoContainer"><a href="http:#"><img src="./assets/icons/bloggerLogoBlack.svg" alt="blogger logo"></a></div>
                <nav class="headerMenuContainer align-item-end">
                    <ul class="d-flex justify-content-between">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Resources</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#" class="btn p-0 border-0">Contact Us</a></li>
                    </ul>
                </nav>
            </header>
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
            <!-- blog contents container starts here -->
            <section class="blogContentContainer">
                <nav>
                    <ul class="d-flex justify-content-between">
                        <li><a href="#">All</a></li>
                        <li><a href="#">Design</a></li>
                        <li><a href="#">Branding</a></li>
                        <li><a href="#">Illustrations</a></li>
                        <li><a href="#">Icons</a></li>
                        <li><a href="#">Themes</a></li>
                    </ul>
                </nav>

                <section class="blogPostContainer d-flex justify-content-between">

                    <?php
                        // $blogPostInputs = BlogPostValiator::getBlogPosts();
                        // echo var_dump($blogPostInputs);

                        // foreach ($blogPostInputs as $blogPostInput)
                        // {
                        //     // echo $blogPostInput->validateBlogTitle();
                        // }
                    ?>
                    <div class="postCard">
                        <!-- blog post card starts here -->
                        <div class="postPhoto">
                            <img class="img-fluid rounded-2" src="./assets/images/greenLeafPlant.jpg" alt="green leaf plant">
                        </div>
                        <div class="postCategory rounded-1 d-flex justify-content-between p-2 px-3 my-2">
                            <p>gardening</p>
                            <p>5 min Read</p>
                        </div>
                        <div class="postTitle">
                            <p class="h6">Lorem ipsum dolor, Temporibus sit amet adipisicing elit...</p>
                        </div>
                        <div class="postParagraph">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus laboriosam fugiat quisquam
                                sequi quasi voluptas, officia minima molestias?
                            </p>
                        </div>
                        <div class="readPostBtn pt-3"><a class="btn" href="http:#">Read full article</a></div>
                    </div>

                    <div class="postCard">
                        <!-- blog post card starts here -->
                        <div class="postPhoto">
                            <img class="img-fluid rounded-2" src="./assets/images/greenLeafPlant.jpg" alt="green leaf plant">
                        </div>
                        <div class="postCategory rounded-1 d-flex justify-content-between p-2 px-3 my-2">
                            <p>gardening</p>
                            <p>5 min Read</p>
                        </div>
                        <div class="postTitle">
                            <p class="h6">Lorem ipsum dolor, Temporibus sit amet adipisicing elit...</p>
                        </div>
                        <div class="postParagraph">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus laboriosam fugiat quisquam
                                sequi quasi voluptas, officia minima molestias?
                            </p>
                        </div>
                        <div class="readPostBtn pt-3"><a class="btn" href="http:#">Read full article</a></div>
                    </div>

                    <div class="postCard">
                        <!-- blog post card starts here -->
                        <div class="postPhoto">
                            <img class="img-fluid rounded-2" src="./assets/images/greenLeafPlant.jpg" alt="green leaf plant">
                        </div>
                        <div class="postCategory rounded-1 d-flex justify-content-between p-2 px-3 my-2">
                            <p>gardening</p>
                            <p>5 min Read</p>
                        </div>
                        <div class="postTitle">
                            <p class="h6">Lorem ipsum dolor, Temporibus sit amet adipisicing elit...</p>
                        </div>
                        <div class="postParagraph">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus laboriosam fugiat quisquam
                                sequi quasi voluptas, officia minima molestias?
                            </p>
                        </div>
                        <div class="readPostBtn pt-3"><a class="btn" href="http:#">Read full article</a></div>
                    </div>

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
                            <li><a href="#"><img src="./assets/icons/pinterestIcon.svg" alt="follow us on Facebook"></a></li>
                            <li><a href="#"><img src="./assets/icons/youtubeIcon.svg" alt="follow us on Youtube"></a></li>
                            <li><a href="#"><img src="./assets/icons/facebookIcon.svg" alt="follow us on Facebook"></a></li>
                            <li><a href="#"><img src="./assets/icons/twitterIcon.svg" alt="follow us on Twitter"></a></li>
                        </ul>
                    </li>
                    <li class="logoList mt-3"><a href="#"><img src="./assets/icons/bloggerLogoWhite.svg" alt="Blogger.com"></a></li>
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

                        <form action="./classes/post.controller.php" method="post" enctype="multipart/form-data"> <!-- form starts here -->

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create a Blog Post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body px-4 my-2"> <!-- modal body starts here -->
                                    
                                <label for="title">Blog title<span class="ms-1 text-danger">*</span></label> <!-- Blog title starts here -->
                                <div class="input-group mt-2 mb-3"> 
                                    <span class="input-group-text" id="addon-wrapping">
                                        <i class="bi bi-card-heading"></i>
                                    </span>
                                    <input type="text" class="form-control py-2" name="title" placeholder="Add blog title" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                </div>

                                <label for="title">Blog category<span class="ms-1 text-danger">*</span></label> <!-- Blog category starts here -->
                                <div class="input-group mt-2 mb-3">
                                    <span class="input-group-text rounded-0 rounded-start border-end-0" id="addon-wrapping">
                                        <i class="bi bi-list"></i>
                                    </span>
                                    <select class="form-select" name="category" id="floatingSelect" aria-label="Floating label select example">
                                        <option value="">Select a category</option>
                                        <option value="gardening">Gardening</option>
                                        <option value="travel">Travel</option>
                                        <option value="fitness">Fitness</option>
                                    </select>
                                </div>

                                <label for="title">Blog description<span class="ms-1 text-danger">*</span></label> <!-- blog description starts here-->
                                <div class="input-group mt-2 mb-3"> <!-- comment field -->
                                    <span class="input-group-text rounded-0 rounded-start border-end-0" id="addon-wrapping">
                                        <i class="bi bi-pencil-square"></i>
                                    </span>
                                    <textarea class="form-control rounded-0 rounded-end" name="description" placeholder="Add blog description" id="floatingTextarea2" style="height: 100px"></textarea>
                                </div>

                                <label for="title">Blog photo<span class="ms-1 text-danger">*</span></label> <!-- upload blog photo starts here-->
                                <div class="input-group mt-2 mb-3">
                                    <span class="input-group-text rounded-0 rounded-start border-end-0" id="addon-wrapping">
                                        <i class="bi bi-card-image"></i>
                                    </span>
                                    <input type="file" name="photo" class="form-control" id="inputGroupSelect01" aria-describedby="inputGroupFileAddon01" aria-label="Upload">
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
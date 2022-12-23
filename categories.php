<?php
require './classes/dbConnect.php'; // DbConnect
require './classes/post.queryDb.php'; // PostDbConnector
require './classes/post.validator.php'; // PostValidator
require './classes/category.validator.php'; // CategoryValidator

$categoryCreated = "";

if (isset($_POST['saveAddCategory'])) // Checks if addCategory form is submitted
{
    $validateAddCategoryData = new CategoryValidator();
    $validateAddCategoryData->setAddCategory($_POST['addCategory']);
    $errors = $validateAddCategoryData->validateAddcategoryInputs();

    if (!$errors) {
        $insertNewCategory = new CategoryQueryDb();
        $insertNewCategory->setAddCategory($_POST['addCategory']);

        $newCategory = $insertNewCategory->saveNewCategory();

        if ($newCategory === "successful") {
            $categoryCreated = true;
        }
    }
}


?>

<body>

    <?php if ($categoryCreated) : ?>
        <div class="successAlert position-absolute mt-5 top-0 start-50 translate-middle alert d-flex align-items-center" role="alert">
            <p><i class="bi bi-emoji-frown me-1"></i> Category created successful!</p>
        </div>
    <?php endif ?>

    <div class="mainContainer">
        <!-- contains all the page contents -->

        <?php include './headers/categoriesHeader.php' ?>
        <!-- header goes here -->

        <section class="categoriesWrapper ">

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">SN</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $result = new CategoryQueryDb();
                    $categories = $result->fetchAllCategories();
                    foreach ($categories as $category) {

                    ?>
                        <tr>

                            <th scope="row"><?= $category['id'] ?></th>
                            <td><?= $category['addCategory'] ?></td>
                            <td><?= $category['dateCreated'] ?></td>

                            <td>
                                <a href="editCategory.php?id=<?= $category['id'] ?>" class="me-3"><i class="bi bi-pencil-square"></i></a>
                                <a href="#"><i class="bi bi-trash"></a></i>
                            </td>
                        <?php
                    }
                        ?>
                        </tr>
                </tbody>
            </table>

        </section>

        <footer class="d-flex justify-content-between align-items-center ">
            <!-- footer -->

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

        <!-- Category modal container starts here ###################################################################-->
        <!-- Button trigger modal -->
        <button type="button" class="postBtn border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-plus-circle"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content modalContent">

                    <form id="savePostData" action="" method="post">
                        <!-- form starts here -->

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body px-4 my-2">
                            <!-- modal body starts here -->
                            <label for="title">Category name<b class="text-danger"> * </b><span class="text-danger"><?= $errors['addCategory'] ?? '' ?></span></label> <!-- Blog title starts here -->
                            <div class="input-group mt-2 mb-4">
                                <span class="input-group-text" id="addon-wrapping">
                                    <i class="bi bi-card-heading"></i>
                                </span>
                                <input type="text" class="form-control py-2" name="addCategory" placeholder="Enter category name">
                            </div>
                        </div> <!-- modal body ends here -->

                        <div class="modal-footer">
                            <!-- modal footer -->
                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                            <button type="submit" name="saveAddCategory" class="sendPostBtn btn btn-primary me-2">Save <i class="bi bi-plus-circle"></i></button>
                        </div>

                    </form> <!-- form ends here -->

                </div>

            </div>
        </div>

    </div>


    </div>
</body>

</html>
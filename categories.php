<?php
require './classes/dbConnect.php'; // DbConnect
require './classes/category.validator.php'; // CategoryValidator

if (isset($_POST['saveAddCategory'])) // Checks if addCategory form is submitted
{
    $validateAddCategoryData = new CategoryValidator();
    $validateAddCategoryData->setAddCategory($_POST['addCategory']);
    $errors = $validateAddCategoryData->validateCategory();

    if (!$errors)
    {
        $insertNewCategory = new CategoryQueryDb();
        $insertNewCategory->setAddCategory($_POST['addCategory']);
        $newCategory = $insertNewCategory->saveNewCategory();
    }
}

if (isset($_GET['deleteId']))
{
    $deleteAlert = false;
    $id = $_GET['deleteId'];
    $result = new CategoryQueryDb();
    $result->deleteCategory($id);
}

if (isset($_POST['saveEditedCategory'])) {
    $id = $_GET['id'];
    $results = new CategoryQueryDb();
    $result = $results->editCategory($id);
}

?>

<body>

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
                        foreach ($categories as $key => $category):?>

                        <tr>
                            <th scope="row"><?= $key + 1 ?></th>
                            <td><?= $category['addCategory'] ?></td>
                            <td><?= $category['dateCreated'] ?></td>
                            <td>
                                <a href="categories.php?editId=<?= $category['id'] ?>" class="me-3" data-bs-toggle="modal" data-bs-target="#updateCategoryModal"><i class="bi bi-pencil-square"></i></a>
                                <a href="categories.php?deleteId=<?= $category['id'] ?>"><i class="bi bi-trash"></a></i>
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
            <?php
                if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $results = new CategoryQueryDb();
                $result = $results->fetchOneCategory($id);
                $editCategory = $result['addCategory']; 

            ?>
            <!-- Update Category modal container starts here ###################################################################-->
            <div class="modal fade" id="updateCategoryModal" tabindex="-1" aria-labelledby="updateCategoryModal" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content modalContent"> 

                        <!-- form starts here -->
                        <form id="savePostData" action="" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateCategoryModal">Change Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-4 my-2">
                                <!-- modal body starts here -->
                                <label for="title">New category name<b class="text-danger"> * </b><span class="text-danger"><?= $errors['addCategory'] ?? '' ?></span></label>
                                <div class="input-group mt-2 mb-4">
                                    <span class="input-group-text" id="addon-wrapping">
                                        <i class="bi bi-card-heading"></i>
                                    </span>
                                    <input type="text" class="form-control py-2" name="addCategory" value="<?= $editCategory['addCategory'] ?>" placeholder="Enter new category name">
                                </div>
                            </div>
                            <!-- modal footer -->
                            <div class="modal-footer">
                                <button type="submit" name="saveEditedCategory" class="sendPostBtn btn btn-primary me-2">Update <i class="bi bi-pencil-square"></i></button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
            
            <?php  } ?>
            
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
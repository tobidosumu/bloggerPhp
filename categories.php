<?php
require './classes/dbConnect.php'; // DbConnect
require './classes/category.validator.php'; // CategoryValidator

$categoryNameAdded = false;

if (isset($_POST['createCategoryBtn'])) // Checks if category form is submitted
{
    $checkCategoryName = new CategoryValidator();
    $checkCategoryName->setCategoryName($_POST['categoryName']);
    $errors = $checkCategoryName->validatedCategory();

    if (!$errors)
    {
        $validCategoryName = new CategoryQueryDb();
        $validCategoryName->setCategoryName($_POST['categoryName']);
        $validCategoryName->createCategory();

        $categoryNameAdded = true;
    }
}

if (isset($_GET['deleteId']))
{
    $categoryRow = new CategoryQueryDb();
    $categoryRow->setCategoryId($_GET['deleteId']);
    $categoryRow->deleteCategory();
}

if (isset($_POST['updateCategoryBtn'])) 
{
    $categoryRow = new CategoryQueryDb();
    $categoryRow->setCategoryId($_GET['id']);
    $categoryRow->setCategoryName($_POST['categoryName']);

    $validateNewCategoryName = new CategoryValidator();
    $validateNewCategoryName->setCategoryName($_POST['categoryName']);
    $errors = $validateNewCategoryName->validatedCategory();

    if (!$errors) 
    {
        $categoryRow->updateCategory();
    }
}

?>

<body>

    <div class="mainContainer">

        <?php include './headers/categoriesHeader.php' ?>

        <section class="categoriesWrapper">

            <?php if ($categoryNameAdded): ?>

                <div id="hideSuccessMessage" class="displaySuccessMessage p-4 text-center m-auto border rounded-3">
                    
                    <p>Category name saved successfully!</p>

                    <button type="button" class="btn-close" onclick="hideSuccessMessage()"></button>

                </div>

            <?php endif ?>    

            <?php if (!empty($_GET['id'])): ?>
                
                <form action="" method="post" class="m-auto mb-5 p-3 border rounded-3">

                    <div class="modal-body px-4 my-2">
                        <label for="title">Update Category Name<b class="text-danger"> * </b><span class="text-danger"><?= $errors['categoryName'] ?? '' ?></span></label> <!-- Blog title starts here -->
                        <div class="input-group mt-2 mb-4">
                            <span class="input-group-text" id="addon-wrapping">
                                <i class="bi bi-card-heading"></i>
                            </span>

                            <?php 
                                $categoryRow = new CategoryQueryDb();
                                $categoryRow->setCategoryId($_GET['id']);
                                $category = $categoryRow->fetchOneCategory();
                            ?>

                            <input type="text" class="form-control py-2" name="categoryName" placeholder="New category name" value="<?= $category['categoryName'] ?>">
                        
                        </div>
                    </div> <!-- modal body ends here -->

                    <div class="modal-footer">
                        <button type="submit" name="updateCategoryBtn" class="sendPostBtn btn btn-primary me-4">Update <i class="bi bi-pencil-square"></i></button>
                    </div>

                </form> <!-- form ends here -->

            <?php endif ?>

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
                        $categories = $result->fetchAllCategoryNames();
                        foreach ($categories as $key => $category):?>
                        <tr>
                            <th scope="row"><?= $key + 1 ?></th>
                            <td><?= $category['categoryName'] ?></td>
                            <td><?= $category['dateCreated'] ?></td>
                            <td>
                                <!-- This button opens the UPDATE/EDIT form when clicked -->
                                <a href="categories.php?id=<?= $category['id']; ?>" class="me-3">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <!-- This button deletes a category row -->
                                <a href="categories.php?deleteId=<?= $category['id'] ?>">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>

            </table>
                
        </section>

        <footer class="d-flex justify-content-between align-items-center ">

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

        <!-- This button triggers the CREATE modal -->
        <button type="button" class="postBtn border-0" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="bi bi-plus-circle"></i>
        </button>

        <!-- CREATE Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content modalContent">

                    <form id="savePostData" action="" method="post">
                        <!-- form starts here -->

                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Create Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body px-4 my-2">
                            <!-- modal body starts here -->
                            <label for="title">Category name<b class="text-danger"> * </b><span class="text-danger"><?= $errors['categoryName'] ?? '' ?></span></label> <!-- Blog title starts here -->
                            <div class="input-group mt-2 mb-4">
                                <span class="input-group-text" id="addon-wrapping">
                                    <i class="bi bi-card-heading"></i>
                                </span>
                                <input type="text" class="form-control py-2" name="categoryName" placeholder="Enter category name">
                            </div>
                        </div> <!-- modal body ends here -->

                        <div class="modal-footer">
                            <button type="submit" name="createCategoryBtn" class="sendPostBtn btn btn-primary me-2">Save <i class="bi bi-plus-circle"></i></button>
                        </div>

                    </form> <!-- form ends here -->

                </div>

            </div>
        </div>

    </div>

</body>

</html>
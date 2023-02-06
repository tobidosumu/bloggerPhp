<form action="" method="post" class="m-auto mb-5 p-3 border rounded-3">

    <div class="modal-body px-4 my-2">

        <label for="title">Update Category Name<b class="text-danger"> * </b>

            <span class="text-danger"><?= $errors['categoryName'] ?? '' ?></span>

            <?php if ($categoryNameUpdated):?>

                <span class="text-success">Category name updated successfully!</span>

            <?php endif ?>

        </label>

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
        <button type="submit" name="updateCategoryBtn" class="sendPostBtn btn btn-success me-4">Update <i class="bi bi-pencil-square"></i></button>
    </div>

</form> <!-- form ends here -->
<?php 
    require_once './post.validator.php';
    require_once './post.model.php';
    //TODO validate my data
    //TODO insert my data

    $postValidator = new PostValidator($_POST['title'], $_POST['category'], $_POST['description'], $_FILES['photo']);

    if (isset($_POST['savePostData'])) 
    {
        $fileName = $_FILES['photo']['name'];
        $fileError = $_FILES['photo']['error'];
        $fileSize = $_FILES['photo']['size'];
        $fileTmpName = $_FILES['photo']['tmp_name'];

        $validateTitle = $postValidator->validateTitle();
        $validateCategory = $postValidator->validateCategory();
        $validateDescription = $postValidator->validateDescription();
        $validatePhoto = $postValidator->validatePhoto($fileName, $fileError, $fileSize, $fileTmpName);
    }

    $validateAllPostData = $postValidator->validateAllPostData($validateTitle, $validateCategory, $validateDescription, $validatePhoto, $postValidator);
    $postValidator->InsertBlogData();


?>
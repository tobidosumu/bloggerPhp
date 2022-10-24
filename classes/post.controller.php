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

    if (!$validateTitle['status'])
    {
        print_r($validateTitle['message']);
    }
    elseif (!$validateCategory['status'])
    {
        print_r($validateCategory['message']);
    }
    elseif (!$validateDescription['status'])
    {
        print_r($validateDescription['message']);
    }
    elseif (!$validatePhoto['status'])
    {
        print_r($validatePhoto['message']);
    }
    else {
        $postValidator->insertBlogData();
    }

?>
<?php 

    if (isset($_POST['insertBlogPost'])) 
    {

        require_once './blogPost.class.php';

        $insertBlogData = new BlogPost();

        $insertBlogData->setBlogTitle($_POST['blogTitle']);
        $insertBlogData->setBlogCategory($_POST['blogCategory']);
        $insertBlogData->setBlogDescription($_POST['blogDescription']);
        $insertBlogData->setBlogPhoto($_FILES['blogPhoto']);

        $this->blogPhoto = $_FILES['blogPhoto'];

        // print_r($file);

        $fileName = $_FILES['blogPhoto']['name'];
        $fileTmpName = $_FILES['blogPhoto']['tmp_name'];
        $fileSize = $_FILES['blogPhoto']['size'];
        $fileError = $_FILES['blogPhoto']['error'];
        // $fileType = $_FILES['blogPhoto']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $filesAllowed = array('jpg', 'jpeg', 'png');

        $blogPhoto = implode('', $filesAllowed);

        if (empty($fileName) === false) 
        {
            if (in_array($fileActualExt, $filesAllowed))
            {
                if ($fileError === 0)
                {
                    if ($fileSize < 1000000)
                    {
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = '../uploads/'.$fileNameNew;
                        $this->blogPhoto = move_uploaded_file($fileTmpName, $fileDestination);
                        // echo `Thanks for uploading a ${fileType} image.`;
                        // $insertBlogData->InsertBlogData();

                        // header("Location:../index.php?uploadsuccess");
                    }
                    else 
                    {
                        echo "Your file is larger than 1MB! Please...upload a file with a less size.";
                    }
                }
                else 
                {
                    echo "There was an error uploading this file! Please, try again.";
                }
            }
            else 
            {
                echo "Sorry, this file type is not supported! Please, upload a JPG, JPEG or PNG.";
            }
        }
        else 
        {
            echo "Please upload an image.";
        }

        // var_dump($insertBlogData->InsertBlogData());
        $insertBlogData->InsertBlogData();
        // echo "<script>alert(Data saved successfully!)</script>";
        // header("location:../index.php?msg=Successfully Saved !");

        echo "Blog post inserted successfully!";
    }
?>
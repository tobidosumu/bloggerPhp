<?php 
    require_once 'dbConnect.php';

    class PostValidator
    {
        // properties
        private $title;
        private $category;
        private $description;
        private $photo;

        private $newfile_name;
        protected $dbConn;

        public function __construct($title="", $category="", $description="", $photo="",)
        {
            $this->title = $title;
            $this->category = $category;
            $this->description = $description;
            $this->photo = $photo;

            $this->dbConn = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PWD,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        }

        public function setTitle($title) // set title
        {
            $this->title = $title;
        }

        public function getTitle()
        {
            return $this->title;
        }

        public function setCategory($category) // set category
        {
            $this->category = $category;
        }

        public function getCategory()
        {
            return $this->category;
        }

        public function setDescription($description) // set description
        {
            $this->description = $description;
        }

        public function getDescription() 
        {
            return $this->description; 
        }

        public function setPhoto($photo) // setBlogPhoto
        {
            return $this->photo = $photo;
    
        }
            
        public function getPhoto()
        {
            return $this->photo;
        }

        public function validateTitle() // title validation
        {
            if (empty($this->title))
            {
                return [
                    "status" => false,
                    "message" => "Blog title cannot be empty"
                ];
            }
            elseif (strlen($this->title) < 10)
            {
                return [
                    "status" => false,
                    "message" => "Blog title must be at least 10 chars long!"
                ];
            } 
            elseif (is_numeric($this->title))
            {
                return [
                    "status" => false,
                    "message" => "Blog title cannot be numbers only!"
                ];
            }
            else
            {
                return [
                    "status" => true,
                    "message" => "Data validated"
                ];
            }
        }

        public function validateCategory() // category validation
        {
            if (empty($this->category))
            {
                return [
                    "status" => false,
                    "message" => "Please select a category."
                ];
            }
            else 
            {
                return [
                    "status" => true,
                    "message" => "Good"
                ];
            }
        }

        public function validateDescription() // description validation
        {
            if (empty($this->description))
            {
                return [
                    "status" => false,
                    "message" => "Description cannot be empty!"
                ];
            } 
            elseif (strlen($this->description) < 10)
            {
                return [
                    "status" => false,
                    "message" => "Blog description must be at least 10 chars long!"
                ];
            }
            elseif (is_numeric($this->description))
            {
                return [
                    "status" => false,
                    "message" => "Blog description cannot be numbers only!"
                ];
            }
            else 
            {
                return [
                    "status" => true,
                    "message" => "Description is valid!"
                ];
            }
        }

        public function validatePhoto($fileName, $fileError, $fileSize, $fileTmpName) // photo validation
        {
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $filesAllowed = array('jpg', 'jpeg', 'png');
            $fileNameNew = uniqid('', true).".".$fileActualExt;
            $fileDestination = '../uploads/'.$fileNameNew;
            $this->newfile_name = $fileDestination;

            if (empty($fileName))
            {
                return [
                    "status" => false,
                    "message" => "Please upload a photo."
                ];
            }
            elseif ($fileError)
            {
                return [
                    "status" => false,
                    "message" => "An error occurred while uploading image! Please, try again."
                ];
            }
            elseif (!in_array($fileActualExt, $filesAllowed))
            {
                return [
                    "status" => false,
                    "message" => "Image type not supported! Please, upload a JPG, JPEG or PNG."
                ];
            } 
            elseif ($fileSize > 1000000)
            {
                return [
                    "status" => false,
                    "message" => "Image is too Large! Image size must not be more than 1MB."
                ];
            } 
            else {
                move_uploaded_file($fileTmpName, $fileDestination);
                return [
                    "status" => true,
                    "message" => "Photo uploaded successfully!"
                ];
            }
        }

        public function validateAllPostData($validateTitle, $validateCategory, $validateDescription, $validatePhoto, $postValidator)
        {
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
                return;
            }
        }
        
        // to be moved to post.model.php class 
        public function InsertBlogData() // Insert blog data
        {
            try {
                $stmt = $this->dbConn->prepare("INSERT INTO blog_post(title, category, description, photo)
                VALUES(?, ?, ?, ?)");
                
                if($stmt->execute([$this->title, $this->category, $this->description, $this->newfile_name]))
                {
                    echo "Post uploaded successfully!";
                    header("Location:../index.php");
                }
            } catch (Exception $e) {
                echo "failed";
                return $e->getMessage();
            }
        }
    }
?>
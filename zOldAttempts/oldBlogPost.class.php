<?php 
require_once './dbConnect.php';

    class BlogPost 
    {
        private $id;
        private $blogTitle;
        private $blogCategory;
        private $blogDescription;
        private $blogPhoto;

        protected $dbConn;

        public function __construct($id=0, $blogTitle="", $blogCategory="", $blogDescription="", $blogPhoto)
        {
            $this->id = $id;
            $this->blogTitle = $blogTitle;
            $this->blogCategory = $blogCategory;
            $this->blogDescription = $blogDescription;
            $this->blogPhoto = $blogPhoto;

            $this->dbConn = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PWD,[PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setBlogTitle($blogTitle)
        {
            $this->blogTitle = $blogTitle;
        }

        public function getBlogTitle()
        {
            return $this->blogTitle;
        }

        public function setBlogCategory($blogCategory) // setBlogCategory
        {
            $this->blogCategory = $blogCategory;
        }

        public function getBlogCategory()
        {
            return $this->blogCategory;
        }

        public function setBlogDescription($blogDescription) // setBlogDescription
        {
            $this->blogDescription = $blogDescription;
        }

        public function getBlogDescription() 
        {
            return $this->blogDescription; 
        }

        public function setBlogPhoto($blogPhoto) // setBlogPhoto
        {
            $this->blogPhoto = $blogPhoto;
    
        }
            
        public function getBlogPhoto()
        {
            return $this->blogPhoto;
        }

        // Database operations - CRUD
        
        // Insert blog data
        public function InsertBlogData()
        {
            try {
                $stmt = $this->dbConn->prepare("INSERT INTO blog_post(blogTitle,blogCategory,blogDescription,blogPhoto) VALUES(?,?,?,?)");
                $stmt->execute([$this->blogTitle,$this->blogCategory,$this->blogDescription,$this->blogPhoto]);
                // header("Location:../index.php");
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }
?>
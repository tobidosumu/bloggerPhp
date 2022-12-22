<?php 

    class PostQueryDb extends DbConnect
    {
        private $id;
        private $title;
        private $category;
        private $addCategory;
        private $description;

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setTitle($title)
        {
            $this->title = $title;
        }

        public function setCategory($category)
        {
            $this->category = $category;
        }

        public function setAddCategory($addCategory)
        {
            $this->addCategory = $addCategory;
        }

        public function setDescription($description)
        {
            $this->description = $description;
        }

        public function saveNewCategory()
        {
            try {
                $stmt = $this->connect()->prepare("INSERT INTO categories(addCategory) VALUES(?)");
                $stmt->execute([$this->addCategory]);
                return "successful";
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }

        public function savePostData() // Insert blog data
        {
            $fileName = $_FILES['photo']['name'];
            $fileTmpName = $_FILES['photo']['tmp_name'];

            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            $newImageName = uniqid('', true).".".$imageExtension;

            $imageDestination = 'uploads/'.$newImageName;

            move_uploaded_file($fileTmpName, $imageDestination);

            try {
                $stmt = $this->connect()->prepare("INSERT INTO blog_post(title, category, description, photo)
                VALUES(?, ?, ?, ?)");
                $stmt->execute([$this->title, $this->category, $this->description, $imageDestination]);
                return "successful";
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }

        public function fetchOne($id)
        {
            try 
            {
                $stmt = $this->connect()->prepare("SELECT * FROM blog_post WHERE id=? LIMIT 1");
                $stmt->execute([$id]);
                return $stmt->fetch();
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }

        public function fetchAllCategories() // fetch all data from blog_post table
        {
            try 
            {
                $stmt = $this->connect()->prepare("SELECT * FROM categories ORDER BY id DESC");
                $stmt->execute();
                return $stmt->fetchAll();
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }

        public function fetchAll() // fetch all data from blog_post table
        {
            try 
            {
                $stmt = $this->connect()->prepare("SELECT * FROM blog_post ORDER BY id DESC");
                $stmt->execute();
                return $stmt->fetchAll();
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }

        public function editCategory()
        {
            try 
            {
                $stmt = $this->connect()->prepare("UPDATE categories SET addCategory = ? WHERE id = ?");
                $stmt->execute([$this->addCategory, $this->id]);
                return "successful";
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }

        public function deleteCategory()
        {
            try 
            {
                $stmt = $this->connect()->prepare("DELETE FROM categories WHERE id = ?");
                $stmt->execute([$this->id]);
                return "successful";
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }
    }
?>
<?php 

    class PostQueryDb extends DbConnect
    {
        private $id;
        private $title;
        private $category;
        private $description;

        public function setId($id)
        {
            $this->id = $id;
        }

        public function setTitle($title)
        {
            $this->title = $title;
        }

        public function setCategory($category)
        {
            $this->category = $category;
        }

        public function setDescription($description)
        {
            $this->description = $description;
        }

        public function savePostData() // Save blog title, category, description, photo
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

        public function fetchOne($id) // Fetch one set of post data i.e. one blog title, category, description, photo
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

        public function fetchAll() // Fetch all post data from DB
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

        public function deletePost($id)
        {
            try 
            {
                $stmt = $this->connect()->prepare("DELETE FROM blog_post WHERE id = ?");
                $stmt->execute([$id]);

                return "successful";
            }
            catch (Exception $e)
            {
                return $e->getMessage();
            }
        }
    }
?>
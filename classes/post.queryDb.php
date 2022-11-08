<?php 

    class PostQueryDb extends DbConnect
    {
        private $data;
        private $id;
        private $title;
        private $category;
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

        public function setDescription($description)
        {
            $this->description = $description;
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
                
                print_r(
                    '<div class="myAlert position-absolute mt-5 top-0 start-50 translate-middle alert d-flex align-items-center" role="alert">
                        <div>
                            <i class="bi bi-emoji-smile"></i>
                            Post created successfully!
                        </div>
                    </div>'
                );

                header('Refresh:3; url=main.php');
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
    }
?>
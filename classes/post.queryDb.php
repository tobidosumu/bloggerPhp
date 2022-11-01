<?php 

    class PostQueryDb extends DbConnect
    {
        private $data;

        public function __construct($postData)
        {
            $this->data = $postData;
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
                $stmt->execute([$this->data['title'], $this->data['category'], $this->data['description'], $imageDestination]);
                
                print_r(
                    '<div class="myAlert position-absolute mt-5 top-0 start-50 translate-middle alert alert-success d-flex align-items-center" role="alert">
                        <div>
                            <i class="bi bi-emoji-smile"></i>
                            Post created successfully!
                        </div>
                    </div>'
                );

                header('Refresh:5; url=main.php');
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
                $stmt = $this->connect()->prepare("SELECT * FROM blog_post");
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
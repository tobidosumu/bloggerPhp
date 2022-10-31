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
            try {
                $stmt = $this->connect()->prepare("INSERT INTO blog_post(title, category, description, photo)
                VALUES(?, ?, ?, ?)");
                $stmt->execute([$this->data['title'], $this->data['category'], $this->data['description'], $_FILES['photo']['name']]);
                
                print_r(
                    '<div class="myAlert position-absolute mt-5 top-0 start-50 translate-middle alert alert-success d-flex align-items-center" role="alert">
                        <div>
                            <i class="bi bi-emoji-smile"></i>
                            Post created successfully!
                        </div>
                    </div>'
                );

                header('Refresh:10; url=index.php');
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
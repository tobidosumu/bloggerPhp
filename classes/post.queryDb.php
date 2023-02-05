<?php 

    class PostQueryDb extends DbConnect
    {
        private $post_id;
        private $title;
        private $category;
        private $description;

        public function setPostId($post_id)
        {
            $this->post_id = $post_id;
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

        public function insertPost() // Saves blog title, category, description, photo
        {
            $fileName = $_FILES['photo']['name'];
            $fileTmpName = $_FILES['photo']['tmp_name'];

            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            $newImageName = uniqid('', true).".".$imageExtension;

            $imageDestination = 'uploads/'.$newImageName;

            move_uploaded_file($fileTmpName, $imageDestination);

            try {
                $stmt = $this->connect()->prepare("INSERT INTO posts(title, category_id, description, photo)
                VALUES(?, ?, ?, ?)");
                $stmt->execute([$this->title, $this->category, $this->description, $imageDestination]);
                return "successful";
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }

        public function fetchOnePost() // Fetch one set of post data i.e. one blog title, category, description, photo
        {
            try 
            {
                $query = "SELECT 
                            posts.post_id, 
                            posts.title, 
                            posts.description, 
                            posts.photo,
                            posts.created_at,
                            categories.categoryName 
                        FROM posts
                        INNER JOIN categories ON posts.category_id=categories.id
                        WHERE post_id=?";

                $stmt = $this->connect()->prepare($query);
                $stmt->execute([$this->post_id]);
                return $stmt->fetch();
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }

        public function fetchAllPosts() // Fetch all data from post and fetch id from category
        {
            try 
            {
                $query = "SELECT 
                            posts.post_id, 
                            posts.title, 
                            posts.description, 
                            posts.photo,
                            posts.created_at,
                            categories.categoryName 
                        FROM posts
                        INNER JOIN categories ON posts.category_id=categories.id
                        ORDER BY posts.created_at DESC";

                $stmt = $this->connect()->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll();
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }

        public function deletePost($post_id)
        {
            try 
            {
                $stmt = $this->connect()->prepare("DELETE FROM posts WHERE post_id = ?");
                $stmt->execute([$post_id]);

                return "successful";
            }
            catch (Exception $e)
            {
                return $e->getMessage();
            }
        }
    }

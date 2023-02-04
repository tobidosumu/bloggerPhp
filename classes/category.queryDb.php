<?php 

    class CategoryQueryDb extends DbConnect
    {
        private $id;
        private $categoryName;

        public function setCategoryId($id)
        {
            $this->id = $id;
        }

        public function setCategoryName($categoryName)
        {
            $this->categoryName = $categoryName;
        }

        public function createCategory() // Insert category into DB
        {
            try {
                // Convert categoryName to uppercase
                $categoryName = ucfirst($this->categoryName);
        
                // Insert new category into the categories table
                $stmt = $this->connect()->prepare("INSERT INTO categories(categoryName, dateCreated) VALUES(?, NOW())");
                $stmt->execute([$categoryName]);
                
                // Select the new category and the formatted dateCreated value
                $stmt = $this->connect()->prepare("SELECT c.categoryName, DATE_FORMAT(c.dateCreated, '%d-%b-%Y') AS formatted_date FROM categories c WHERE c.categoryName = ?");
                $stmt->execute([$categoryName]);
                return $stmt->fetch();
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }        

        public function fetchOneCategory() // Fetch one category from DB
        {
            try 
            {
                $stmt = $this->connect()->prepare("SELECT * FROM categories WHERE id=? LIMIT 1");
                $stmt->execute([$this->id]);
                return $stmt->fetch();
            } 
            catch (Exception $e) 
            {
                return $e->getMessage();
            }
        }

        public function fetchAllCategoryNames() // Fetch all categories from DB
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

        public function updateCategory()
        {
            try {
                // Convert categoryName to uppercase
                $categoryName = ucfirst($this->categoryName);
        
                // Update category in the categories table
                $stmt = $this->connect()->prepare("UPDATE categories SET categoryName = ? WHERE id = ?");
                $stmt->execute([$categoryName, $this->id]);
        
                return "successful";
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }        

        public function deleteCategory($id) // Delete category from DB
        {
            try 
            {
                $stmt = $this->connect()->prepare("DELETE FROM categories WHERE id = ?");
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
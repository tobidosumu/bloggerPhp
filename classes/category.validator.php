<?php

    require 'category.queryDb.php';

    class CategoryValidator extends CategoryQueryDb
    {
        private $categoryName;
        private $errors = [];

        public function setCategoryName($categoryName)
        {
            $this->categoryName = $categoryName;
        }

        public function validatedCategory()
        {
            $this->validateCategoryName();
            return $this->errors;
        }

        private function validateCategoryName()
        {
            $selectDefaultVal = "Select a category";
            $val = filter_var($this->categoryName);

            if ($selectDefaultVal === $val)
            {
                $this->addError('category', 'Please select a category.');
            }
            if ($val === false || $val === null || empty($val))
            {
                $this->addError('categoryName', 'Please enter a category name.');
            }
            elseif (strlen($val) < 2)
            {
                $this->addError('categoryName', 'Category name must be at least 2 chars long.');
            }
            elseif (str_word_count($val) > 1)
            {
                $this->addError('categoryName', 'Category name cannot be more than one word.');
            }
            elseif (is_numeric($val))
            {
                $this->addError('categoryName', 'Category name cannot be numbers only.');
            }
            elseif (preg_match('([!@#$%^&*(),.?":{}|<>])', $val))
            {
                $this->addError('categoryName', 'Category name cannot be solely special chars.');
            }

            // Check if the categoryName input matches a category in the database
            $categories = $this->fetchAllCategoryNames();
            
            foreach ($categories as $category) 
            {
                if (strcasecmp($val, $category['categoryName']) === 0) 
                {
                    $this->addError('categoryName', 'Category name already exists.');
                }
            }
        }

        private function addError($key, $inputVal)
        {
            $this->errors[$key] = $inputVal;
        }
    }
?>
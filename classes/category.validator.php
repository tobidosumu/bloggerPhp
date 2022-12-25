<?php

    require 'category.queryDb.php';

    class CategoryValidator extends CategoryQueryDb
    {
        private $addCategory;
        private $errors = [];

        public function setAddCategory($addCategory)
        {
            $this->addCategory = $addCategory;
        }

        public function validateCategory()
        {
            $this->validateAddCategory();
            return $this->errors;
        }

        private function validateAddCategory()
        {
            $selectDefaultVal = "Select a category";
            $val = filter_var($this->addCategory);
            // $val = $this->category;

            if ($selectDefaultVal === $val)
            {
                $this->addError('category', 'Please select a category.');
            }

            if ($val === false || $val === null || empty($val))
            {
                $this->addError('addCategory', 'Please enter a category.');
            }
            elseif (strlen($val) < 2)
            {
                $this->addError('addCategory', 'Category must be at least 2 chars long.');
            }
            elseif (str_word_count($val) > 1)
            {
                $this->addError('addCategory', 'Category cannot be more than one word.');
            }
            elseif (is_numeric($val))
            {
                $this->addError('addCategory', 'Category cannot be numbers only.');
            }
            elseif (preg_match('([!@#$%^&*(),.?":{}|<>])', $val))
            {
                $this->addError('addCategory', 'Category cannot be solely special chars.');
            }

             // Check if the addCategory input matches a category in the database
            $categories = $this->fetchAllCategories();
            foreach ($categories as $category) 
            {
                if (strcasecmp($val, $category['addCategory']) === 0) 
                {
                    $this->addError('addCategory', 'Category already exists.');
                    break;
                }
            }
        }

        private function addError($key, $inputVal)
        {
            $this->errors[$key] = $inputVal;
        }
    }
?>
<?php

    class AddCategoryValidator extends PostQueryDb
    {
        private $addCategory;
        private $errors = [];

        public function setAddCategory($addCategory)
        {
            $this->addCategory = $addCategory;
        }

        public function validateAddcategoryInputs()
        {
            $this->validateAddCategory();
            return $this->errors;
        }


        private function validateAddCategory()
        {
            $inputVal = filter_var($this->addCategory);

            if ($inputVal === false || $inputVal === null || empty($inputVal))
            {
                $this->addError('addCategory', 'Please enter a category.');
            }
            elseif (strlen($inputVal) < 2)
            {
                $this->addError('addCategory', 'Category must be at least 2 chars long.');
            }
            elseif (str_word_count($inputVal) > 1)
            {
                $this->addError('addCategory', 'Category cannot be more than one word.');
            }
            elseif (is_numeric($inputVal))
            {
                $this->addError('addCategory', 'Category cannot be numbers only.');
            }
            elseif (preg_match('([!@#$%^&*(),.?":{}|<>])', $inputVal))
            {
                $this->addError('addCategory', 'Category cannot be solely special chars.');
            }
             // Check if the addCategory input matches a category in the database
            $categories = $this->fetchAllCategories();
            foreach ($categories as $category) 
            {
                if (strcasecmp($inputVal, $category['addCategory']) === 0) 
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
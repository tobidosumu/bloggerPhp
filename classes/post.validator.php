<?php 
    class PostValidator
    {
        private $data;
        private $errors = [];
        private static $fields = ['title', 'category', 'description', 'photo'];

        // image properties
        private $fileName;
        private $fileSize;
        private $fileError;
        private $fileTmpName;

        public function __construct($postData)
        {
            $this->data = $postData;

            $this->fileName = $_FILES['photo']['name'];
            $this->fileSize = $_FILES['photo']['size'];
            $this->fileError = $_FILES['photo']['error'];
            $this->fileTmpName = $_FILES['photo']['tmp_name'];
        }

        public function validatePostData()
        {
            // foreach (self::$fields as $field) 
            // {
            //     if (!array_key_exists($field, $this->data))
            //     {
            //         trigger_error("$field does not exists!");
            //         return;
            //     }
            // }
            $this->validateTitle();
            $this->validateCategory();
            $this->validateDescription();
            $this->validatePostPhoto();
            return $this->errors;
        }

        private function validateTitle()
        {
            $val = trim($this->data['title']);
            $val = strip_tags($val);

            $onlySpecialChars = preg_match('([!@#$%^&*(),.?":{}|<>])', $val);
            $notSpecialChars = preg_match('(.*[a-z]|[A-Z]|[0-9])', $val);

            if (empty($val))
            {
                $this->addError('title', 'Please enter a title.');
            }
            elseif (strlen($val) < 10)
            {
                $this->addError('title', 'Title must be at least 20 chars long.');
            }
            elseif (strlen($onlySpecialChars) > strlen($notSpecialChars))
            {
                $this->addError('description', 'Description cannot be mostly special chars.');
            }
        }

        private function validateCategory()
        {
            $val = trim($this->data['category']);
            $val = strip_tags($val);

            // print_r($val);
            // die;

            $onlySpecialChars = preg_match('([!@#$%^&*(),.?":{}|<>])', $val);
            $notSpecialChars = preg_match('(.*[a-z]|[A-Z]|[0-9])', $val);

            if (empty($val))
            {
                $this->addError('category', 'Please select a category.');
            }
            elseif (strlen($val) < 2)
            {
                $this->addError('category', 'Category must be at least 2 chars long.');
            }
            elseif (is_numeric($val))
            {
                $this->addError('category', 'Category cannot be numbers only.');
            }
            elseif (strlen($onlySpecialChars) > strlen($notSpecialChars))
            {
                $this->addError('description', 'Description cannot be mostly special chars.');
            }
        }

        private function validateDescription()
        {
            $val = trim($this->data['description']);

            $onlySpecialChars = preg_match('([!@#$%^&*(),.?":{}|<>])', $val);
            $notSpecialChars = preg_match('(.*[a-z]|[A-Z]|[0-9])', $val);

            if (empty($val))
            {
                $this->addError('description', 'Please enter a description.');
            }
            elseif (strlen($val) < 50)
            {
                $this->addError('description', 'Description must be at least 50 chars long.');
            }
            elseif (strlen($onlySpecialChars) > strlen($notSpecialChars))
            {
                $this->addError('description', 'Description cannot be mostly special chars.');
            }
        }

        private function validatePostPhoto()
        {
            $validImageExtension = ['jpeg', 'jpg', 'png', 'gif', 'jfif'];
            $imageExtension = explode('.', $this->fileName);
            $imageActualExtension = strtolower(end($imageExtension));

            if (empty($this->fileName))
            {
                $this->addError('photo', 'Please upload a photo.');
            }
            elseif ($this->fileError === 1)
            {
                $this->addError('photo', 'An error occurred. Please try again.');
            }
            elseif (!in_array($imageActualExtension, $validImageExtension))
            {
                $this->addError('photo', 'Please upload a valid image type e.g. jpeg, jpg, png, jfif or gif.');
            }
            elseif ($this->fileSize > 1000000)
            {
                $this->addError('photo', 'Photo is larger than 2MB.');
            }
        }

        private function addError($key, $val)
        {
            $this->errors[$key] = $val;
        }

    }
?>
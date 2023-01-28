<?php 

    class PostValidator
    {
        private $title;
        private $category;
        private $description;
        private $timeAgo;
        private $specialChars = ['#', '@', '%', '$', '&', '(', ')']; 
        private $errors = [];

        private $diff;
        private $time;
        private $now;

        // image properties
        private $fileName;
        private $fileSize;
        private $fileError;

        // image element array setter and getter methods
        ###################################################################################################
        public function setFileName($fileName)
        {
            $this->fileName = $fileName;
        }

        private function setSpecialChars($specialChars)
        {
            $this->specialChars = $specialChars;
        }

        public function setFileSize($fileSize)
        {
            $this->fileSize = $fileSize;
        }

        public function setFileError($fileError)
        {
            $this->fileError = $fileError;
        }


        ###################################################################################################
        // setter and getter methods start here

        public function setTimeAgo($time)
        {
            $now = time();
            $diff = $now - $time;

            if($diff < 0) 
            {
                $this->timeAgo = "1 sec ago";
            } 
            else if ($diff < 60) 
            {
                $this->timeAgo = abs($diff) . ' secs ago';
            } 
            else if ($diff == 3600) 
            {
                $this->timeAgo = abs(floor($diff / 60)) . ' min ago';
            } 
            else if ($diff < 3600) 
            {
                $this->timeAgo = abs(floor($diff / 60)) . ' mins ago';
            } 
            else if ($diff == 86400) 
            {
                $this->timeAgo = abs(floor($diff / 3600)) . ' hour ago';
            } 
            else if ($diff < 86400) 
            {
                $this->timeAgo = abs(floor($diff / 3600)) . ' hours ago';
            } 
            else 
            {
                $this->timeAgo = date("F j, Y", $time);
            }
        }
                  
     

        public function getTimeAgo()
        {
            return $this->timeAgo;
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

        #####################################################################################################
        // validation methods start here

        public function validatePostData()
        {
            $this->validateTitle();
            $this->validateCategory();
            $this->validateDescription();
            $this->validatePostPhoto();
            return $this->errors;
        }

        private function validateTitle()
        {
            $val = trim($this->title);

            $onlySpecialChars = preg_match('([!@#$%^&*(),.?":{}|<>])', $val);
            $notSpecialChars = preg_match('(.*[a-z]|[A-Z]|[0-9])', $val);

            if (empty($val))
            {
                $this->addError('title', 'Please enter a title.');
            }
            elseif (!strip_tags($val, $this->specialChars))
            {
                $this->addError('title', 'Special chars are not allowed. Only these are: #@%$&()');
            }
            elseif (strlen($val) < 10)
            {
                $this->addError('title', 'Title must be at least 20 chars long.');
            }
            elseif (strlen($val) > 140)
            {
                $this->addError('title', 'Title cannot be more than 140 chars long.');
            }
            elseif (strlen($onlySpecialChars) > strlen($notSpecialChars))
            {
                $this->addError('description', 'Description cannot be mostly special chars.');
            }
        }

        private function validateCategory()
        {
            $selectDefaultVal = "Select a category";
            $val = $this->category;

            if ($selectDefaultVal === $val)
            {
                $this->addError('category', 'Please select a category.');
            }
        }

        private function validateDescription()
        {
            $val = trim($this->description);

            $onlySpecialChars = preg_match('([!@#$%^&*(),.?":{}|<>])', $val);
            $notSpecialChars = preg_match('(.*[a-z]|[A-Z]|[0-9])', $val);

            if (empty($val))
            {
                $this->addError('description', 'Please enter a description.');
            }
            elseif (!strip_tags($val, $this->specialChars))
            {
                $this->addError('description', 'Special chars are not allowed. Only these are: #@%$&()');
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
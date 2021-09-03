<?php

    class validationResult{

        private $value;
        private $cssClassName;
        private $errorMessage;
        private $isValid;

        public function __construct($cssClassName, $value ,$errorMessage, $isValid)
        {
            $this->value = $value;
            $this->cssClassName = $cssClassName;
            $this->errorMessage = $errorMessage;
            $this->isValid = $isValid;
        }

        public function getValue(){ return $this->value; }
        public function getCssClassName(){ return $this->cssClassName; }
        public function getErrorMessage(){ return $this->errorMessage; }
        public function setErrorMessage($error){ $this->errorMessage = $error; }
        public function isValid(){ return $this->isValid; }
        public function setIsValid($isValid){ $this->isValid = $isValid; }

        public static function checkParameter($name, $pattern, $errMsg): validationResult{

            $error = '';
            $errClass = '';
            $value = '';
            $isValid = true;

            if(empty($_POST[$name])){
                $error = $errMsg;
                $errClass = "error";
                $isValid = false;
            }else{
                $value = $_POST[$name];

                if($name == 'firstname' || $name == 'lastname' || $name == 'password1' || $name == 'password2'){
                    if(preg_match($pattern, $value)){
                        $error = $errMsg;
                        $errClass = "error";
                        $isValid = false;
                    }
                }else{
                    if(!preg_match($pattern, $value)){
                        $error = $errMsg;
                        $errClass = "error";
                        $isValid = false;
                    }
                }
            }

            return new validationResult($errClass, $value, $error, $isValid);
            
        }

    }

?>
<?php
    class catchJSON {
        private $request;
        public function __construct(){
            $this->request = file_get_contents("php://input");  
        }
        
        public function get_string(){
            return $this->request;
        }

        public function get_array(){
            return json_decode($this->request);
        }

        public function get_array_assoc(){
            return json_decode($this->request,true);
        }
    }

?>

<? 
    class Response {
        public $response;
        public $errors;          

        public function set_response($value){  
            $this->response = $value;
        }

        public function set_error($text, $number){            
            $this->errors[]= array(
                'error_info' => $text,
                'error_num' => $number,
            ); 
        }

        public function set_error_if($condition, $text, $number){  
            if($condition){
                $this->set_error($text, $number);
            }
        } 

        public function get_response(){            
            return array(
                'response' => $this->response,
                'error' => isset($this->errors[0]),
                'error_info' => $this->errors[0]['error_info'],
                'error_num' => $this->errors[0]['error_num'],
            );
        }

        public function print_json(){
            echo json_encode($this->get_response());
        }
    }
?>
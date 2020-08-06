<?php
    class DataBase {
        
        public $error;
        public $error_num;
        public $connect;
        public $query;
        public $queries;

        public function __construct(){
            $this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Нет подключения к БД");
        }  
        
        public function query($query){            
            $this->query = mysqli_query($this->connect,$query);
            $this->error = mysqli_error($this->connect);
			$this->error_num = mysqli_errno($this->connect);
            return $this->query;
        }
        
        public function multi_query($query) {
            if( mysqli_multi_query($this->connect, $query) ) {
                while( mysqli_more_results($this->connect) && mysqli_next_result($this->connect) ){
                    ;
                }
            }
            $this->error = mysqli_error($this->connect);
            $this->error_num = mysqli_errno($this->connect);
        }

        public function form_queries($query) {
            $this->queries .= $query;
        }
        
        public function confirm_queries() {
            $this->multi_query($this->queries);
        }

        function num_rows($query = '') {
            if ($query == '') $query = $this->query;
    
            return mysqli_num_rows($query);
        }

        function get_row($query = '') {
            if ($query == '') $query = $this->query;    
            return mysqli_fetch_assoc($query);
        } 

        function get_array($query = ''){
            if ($query == '') $query = $this->query;    

            while($row = $this->get_row()){
                $results[]= $row ;
            }
            return $results;
        }

        public function hash($value){
            return password_hash($value, PASSWORD_DEFAULT);
        }

        public function __destruct(){
            mysqli_close($this->connect);
        }

        public function bool_to_sql($bool){
            return $bool?1:0;
        }        
    }
?>

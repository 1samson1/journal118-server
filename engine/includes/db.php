<?
    class DataBase {
        
        public $error;
        public $error_num;
        public $connect;
        public $query;

        public function __construct(){
            $this->connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Нет подключения к БД");
        }        

        public function query($query){
            $this->query = mysqli_query($this->connect,$query);
            $this->error = mysqli_error($this->connect);
			$this->error_num = mysqli_errno($this->connect);
            return $this->query;
        }

        function get_row($query = '') {
            if ($query == '') $query = $this->query;    
            return mysqli_fetch_assoc($query);
        }

        public function reg_user($group_id, $name, $surname, $login, $email, $pass, $miss_user = False){            
            return $this->query('INSERT INTO `users` (`group_id`,`name`,`surname`,`login`,`email`,`miss_user`,`password`) 
                                    VALUE ("'.$group_id.'","'.htmlspecialchars($name).'","'.htmlspecialchars($surname).'","'.htmlspecialchars($login).'","'.htmlspecialchars($email).'","'.$this->bool_to_sql($miss_user).'","'.$this->hash(htmlspecialchars($pass)).'")');
        }

        public function check_user($login){
           return $this->query('SELECT * FROM `users` 
                                    WHERE `login` = "'.htmlspecialchars($login).'"');
        }

        public function add_token($user_id, $token, $info){            
            return $this->query('INSERT INTO `user_tokens` (`user_id`,`token`,`info` ,`date`) 
                                    VALUES ('.$user_id.',"'.$token.'","'.$info.'","'.time().'")');
        }

        public function get_user_token($token){
            return $this->query('SELECT `users`.`id`, `group_id` , `name`, `surname` , `login` , `email`, `miss_user` FROM `user_tokens` 
                                    INNER JOIN `users` ON `user_tokens`.`user_id` = `users`.`id`
                                    WHERE `token` = "'.htmlspecialchars( $token).'"');
        }

        public function hash($value){
            return password_hash($value, PASSWORD_DEFAULT);
        }

        public function __destruct(){
            mysqli_close($this->connect);
        }

        private function bool_to_sql($bool){
            return $bool?1:0;
        }        
    }
?>
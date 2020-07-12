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
            return $this->query('INSERT INTO `users` (`group_id`,`name`,`surname`,`login`,`email`,`miss_user`,`password`) VALUE ("'.$group_id.'","'.htmlspecialchars($name).'","'.htmlspecialchars($surname).'","'.htmlspecialchars($login).'","'.htmlspecialchars($email).'","'.$this->bool_to_sql($miss_user).'","'.password_hash(htmlspecialchars($password), PASSWORD_DEFAULT).'")');
        }

        public function __destruct(){
            mysqli_close($this->connect);
        }

        private function bool_to_sql($bool){
            return $bool?1:0;
        }

        
    }
?>
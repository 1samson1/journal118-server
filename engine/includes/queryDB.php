<?php
    require_once ENGINE_DIR.'/includes/db.php'; // Подключаем файл базовый класса базы данных

    class QueryDB extends DataBase{

        /*////////////////// Query for users tools  ////////////////////*/

        public function reg_user($group_id, $name, $surname, $login, $email, $pass, $miss_user = False){            
            return $this->query('INSERT INTO `users` (`group_id`,`name`,`surname`,`login`,`email`,`miss_user`,`password`) 
                                    VALUE ("'.$group_id.'","'.htmlspecialchars($name).'","'.htmlspecialchars($surname).'","'.htmlspecialchars($login).'","'.htmlspecialchars($email).'","'.$this->bool_to_sql($miss_user).'","'.$this->hash(htmlspecialchars($pass)).'")');
        }
        
        public function check_user($login){
            return $this->query('
                SELECT * FROM `users` 
                    WHERE `login` = "'.htmlspecialchars($login).'"
            ;');
        }

        /*............... Query for work user's token ................*/

        public function add_token($user_id, $token, $info){            
            return $this->query('
                INSERT INTO `user_tokens` (`user_id`,`token`,`info` ,`date`) 
                    VALUES ('.$user_id.',"'.$token.'","'.$info.'","'.time().'")
            ;');
        }

        public function get_user_token($token){
            return $this->query('
                SELECT `users`.`id`, `group_id` , `name`, `surname` , `login` , `email`, `miss_user` FROM `user_tokens` 
                    INNER JOIN `users` ON `user_tokens`.`user_id` = `users`.`id`
                    WHERE `token` = "'.htmlspecialchars( $token).'"
            ;');
        }

        /*////////////////// Query for journal works ////////////////////*/

        public function set_date($date){
            return $this->query('
                INSERT INTO `dates` (`date`) VALUE ('.$date.')
            ;');
        }

        public function get_date($date){
            return $this->query('
                SELECT * FROM `dates` 
                    WHERE `date` = '.$date.';
            ;');
        }

        public function set_dates_work($date_id,$date_work){
            foreach($date_work as $value)                
                $values[]='('.$date_id.','.$value['user_id'].','.$this->bool_to_sql($value['exist']).','.$this->bool_to_sql($value['miss']).','.$value['miss_lessons'].')';
            
            return $this->query('
                INSERT INTO `dates_work` (`date_id`, `user_id`, `exist`, `miss`, `miss_lessons`) 
                    VALUES '.implode(',',$values).'
            ;');             
        }

        public function get_dates_work($date_id){
            return $this->query('
                SELECT * FROM `dates_work` 
                    INNER JOIN `users` ON `users`.`id` = `dates_work`.`user_id`
                    WHERE `date_id` = '.$date_id.'
                    ORDER BY `users`.`name`
            ;');
        }

        /*.................... Query for black and duty list ...............*/

        public function set_black_list($date_id, $user_id){
            return $this->query('
                INSERT INTO `black_list` (`date_id`, `user_id`)
                    VALUE ("'.$date_id.'","'.$user_id.'")
            ;');
        }

        public function set_duty_list($date_id, $user_id){
            echo $user_id;
            return $this->query('
                INSERT INTO `duty_list` (`date_id`, `user_id`)
                    VALUE ("'.$date_id.'","'.$user_id.'")
            ;');
        }

    }
?>

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
                SELECT `dates_work`.* , `users`.`surname`, `users`.`name`  FROM `dates_work` 
                    INNER JOIN `users` ON `users`.`id` = `dates_work`.`user_id`
                    WHERE `date_id` = '.$date_id.'
                    ORDER BY `users`.`surname` ASC, `users`.`name` ASC
            ;');
        }

        public function update_dates_work($date_id, $user_id, $exist, $miss, $miss_lessons = 0){
            $this->form_queries('
                UPDATE `dates_work` 
                    SET `dates_work`.`exist` = '.$this->bool_to_sql($exist).', `dates_work`.`miss` = '.$this->bool_to_sql($miss).' , `dates_work`.`miss_lessons` = '.$miss_lessons.' 
                    WHERE `dates_work`.`date_id` = '.$date_id.' AND `dates_work`.`user_id` = '.$user_id.'
            ;');
        }

        /*.................... Query for black list ...............*/
        
        public function set_black_list($date_id, $user_id, $reason = ''){
            return $this->query('
                INSERT INTO `black_list` (`date_id`, `user_id`, `reason`)
                    VALUE ("'.$date_id.'","'.$user_id.'","'.$reason.'")
            ;');
        }

        public function get_black_list_all(){
            return $this->query('
                SELECT `black_list`.*, `dates`.`date`, `users`.`surname`, `users`.`name` FROM `black_list`
                    INNER JOIN `dates` ON `dates`.`id` = `black_list`.`date_id`
                    INNER JOIN `users` ON `users`.`id` = `black_list`.`user_id`
            ;');
        }
        
        public function remove_black_list($date_id,$user_id){
            return $this->query('
                DELETE FROM `black_list`
                    WHERE `black_list`.`date_id` = '.$date_id.' AND `black_list`.`user_id` = '.$user_id.'
            ;');
        }

        public function remove_black_list_date($date_id){
            return $this->query('
                DELETE FROM `black_list`
                    WHERE `black_list`.`date_id` = '.$date_id.'
            ;');
        }

        public function get_black_list_exist($date_id){
            return $this->query('
                SELECT `dates`.`date` , `black_list`.`date_id` as `previus_date_id` , `black_list`.`user_id`, `black_list`.`reason`, `dates_work`.`date_id`, `users`.`surname`, `users`.`name`  FROM `black_list`
                    INNER JOIN `dates` ON `dates`.`id` = `black_list`.`date_id`
                    INNER JOIN `dates_work` ON `dates_work`.`user_id` = `black_list`.`user_id`
                    INNER JOIN `users` ON `users`.`id` = `black_list`.`user_id`
                    WHERE `dates_work`.`date_id` = '.$date_id.'
                    ORDER BY `black_list`.`date_id` ASC
            ;');
            // AND `dates_work`.`exist` = 1
        }

        /*.................... Query for black list  backup ...............*/

        public function set_black_list_backup($date_id, $user_id, $date_id_backup, $reason = ''){
            return $this->query('
                INSERT INTO `black_list_backup` (`date_id`, `user_id`, `reason` , `date_id_backup`)
                    VALUE ("'.$date_id.'","'.$user_id.'","'.$reason.'","'.$date_id_backup.'")
            ;');
        }
        
        public function get_black_list_backup($date_id_backup){
            return $this->query('
                SELECT * FROM `black_list_backup`
                    WHERE `black_list_backup`.`date_id_backup` = '.$date_id_backup.'
            ;');
        }

        public function remove_black_list_backup($date_id_backup){
            return $this->query('
                DELETE FROM `black_list_backup`
                    WHERE `black_list_backup`.`date_id_backup` = '.$date_id_backup.'
            ;');
        }

        /*.................... Query for duty list ...............*/
        
        public function set_duty_list($date_id, $user_id, $reason = ''){
            return $this->query('
                INSERT INTO `duty_list` (`date_id`, `user_id`, `reason`)
                    VALUE ("'.$date_id.'","'.$user_id.'","'.$reason.'")
            ;');
        }

        public function get_duty_list($date_id){
            return $this->query('
                SELECT * FROM `duty_list`
                    WHERE `duty_list`.`date_id` = '.$date_id.'
            ;');
        }

        public function get_duty_list_all(){
            return $this->query('
                SELECT `duty_list`.*, `dates`.`date`, `users`.`surname`, `users`.`name` FROM `duty_list`
                    INNER JOIN `dates` ON `dates`.`id` = `duty_list`.`date_id`
                    INNER JOIN `users` ON `users`.`id` = `duty_list`.`user_id`
            ;');
        }

        public function remove_duty_list($date_id){
            return $this->query('
                DELETE FROM `duty_list`
                    WHERE `duty_list`.`date_id` = '.$date_id.'
            ;');
        }

    }
?>

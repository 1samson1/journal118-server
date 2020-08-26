<?php
    require_once ENGINE_DIR.'/includes/db.php'; // Подключаем файл базового класса базы данных

    class QueryDB extends DataBase{

        /*////////////////// Query for users tools  ////////////////////*/

        public function reg_user($group_id, $name, $surname, $login, $email, $pass, $miss_user = False){            
            return $this->query('
                INSERT INTO `users` (`group_id`,`name`,`surname`,`login`,`email`,`miss_user`,`password`) 
                    VALUE ("'.$group_id.'","'.htmlspecialchars($name).'","'.htmlspecialchars($surname).'","'.htmlspecialchars($login).'","'.htmlspecialchars($email).'","'.$this->bool_to_sql($miss_user).'","'.$this->hash(htmlspecialchars($pass)).'")
            ;');
        }
        
        public function check_user($login){
            return $this->query('
                SELECT `users`.*, `groups`.`name` AS `group_name` FROM `users`
                    INNER JOIN `groups` ON `users`.`group_id` = `groups`.`id` 
                    WHERE `login` = "'.htmlspecialchars($login).'"
            ;');
        }

        public function update_user_data($user_id, $name, $surname, $login, $email, $pass){
            $pass = isset($pass[0])?', `users`.`password` = "'.$this->hash(htmlspecialchars($pass)).'"' :'';
            
            return $this->query('
                UPDATE `users`
                    SET  
                        `users`.`name` = "'.htmlspecialchars($name).'",
                        `users`.`surname` = "'.htmlspecialchars($surname).'",
                        `users`.`login` = "'.htmlspecialchars($login).'",
                        `users`.`email` = "'.htmlspecialchars($email).'" 
                        '.$pass.'
                    WHERE `users`.`id` = "'.$user_id.'"
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
                SELECT 
                    `users`.`id`,
                    `users`.`group_id`,
                    `users`.`name`,
                    `users`.`surname`,
                    `users`.`login` ,
                    `users`.`email`,
                    `users`.`miss_user`,
                    `groups`.`name` AS `group_name` 
                FROM `user_tokens` 
                    INNER JOIN `users` ON `user_tokens`.`user_id` = `users`.`id`
                    INNER JOIN `groups` ON `users`.`group_id` = `groups`.`id`
                    WHERE `token` = "'.htmlspecialchars( $token).'"
            ;');
        }

        public function get_user_token_all($token){
            return $this->query('
                SELECT `users`.*, `groups`.`name` AS `group_name` FROM `user_tokens` 
                    INNER JOIN `users` ON `user_tokens`.`user_id` = `users`.`id`
                    INNER JOIN `groups` ON `users`.`group_id` = `groups`.`id`
                    WHERE `token` = "'.htmlspecialchars( $token).'"
            ;');
        }

        public function remove_token($token){
            return $this->query('
                DELETE FROM `user_tokens`
                    WHERE `token` = "'.htmlspecialchars( $token).'"
            ;');
        }

        public function remove_token_all($user_id,$token){
            return $this->query('
                DELETE FROM `user_tokens`
                    WHERE `user_id` = "'.htmlspecialchars( $user_id).'" AND `token` != "'.$token.'"
            ;');
        }

        /*////////////////// Query for journal works ////////////////////*/

        /*.................... Query for dates ...............*/

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

        public function get_dates(){
            return $this->query('
                SELECT * FROM `dates`
					ORDER BY `dates`.`id` DESC
            ;');
        }

        /*.................... Query for dates work ...............*/

        public function set_dates_work($date_id,$date_work){
            foreach($date_work as $value)                
                $values[]='('.$date_id.','.$value->user_id.','.$value->exist.','.$value->miss.','.$value->miss_lessons.')';
            
            return $this->query('
                INSERT INTO `dates_work` (`date_id`, `user_id`, `exist`, `miss`, `miss_lessons`) 
                    VALUES '.implode(',',$values).'
            ;');             
        }

        public function update_dates_work($date_id, $user_id, $exist, $miss, $miss_lessons = 0){
            $this->form_queries('
                UPDATE `dates_work` 
                    SET `dates_work`.`exist` = '.$this->bool_to_sql($exist).', `dates_work`.`miss` = '.$this->bool_to_sql($miss).' , `dates_work`.`miss_lessons` = '.$miss_lessons.' 
                    WHERE `dates_work`.`date_id` = '.$date_id.' AND `dates_work`.`user_id` = '.$user_id.'
            ;');
        }

        public function get_dates_work($date_id){
            return $this->query('
                SELECT `dates_work`.* ,`dates`.`date`, `users`.`surname`, `users`.`name`  FROM `dates_work` 
                    INNER JOIN `dates` ON `dates`.`id` = `dates_work`.`date_id`
                    INNER JOIN `users` ON `users`.`id` = `dates_work`.`user_id`
                    WHERE `date_id` = '.$date_id.'
                    ORDER BY `users`.`surname` ASC, `users`.`name` ASC
            ;');
        }

        public function get_dates_work_miss($date_id){
            return $this->query('
                SELECT `dates_work`.* ,`dates`.`date`, `users`.`surname`, `users`.`name`  FROM `dates_work` 
                    INNER JOIN `dates` ON `dates`.`id` = `dates_work`.`date_id`
                    INNER JOIN `users` ON `users`.`id` = `dates_work`.`user_id`
                    WHERE `date_id` = '.$date_id.' AND `users`.`miss_user` = 0
                    ORDER BY `users`.`surname` ASC, `users`.`name` ASC
            ;');
        }

        public function get_dates_work_empty($exist = 1, $miss = 0, $miss_lessons = 0){
            return $this->query('
                SELECT
                    `users`.`id` as `user_id`,
                    `users`.`surname`, 
                    `users`.`name`,
                    "'.$exist.'" AS `exist`,
                    "'.$miss.'" AS `miss`,
                    "'.$miss_lessons.'" AS `miss_lessons`
                FROM `users`
					ORDER BY `users`.`surname` ASC, `users`.`name` ASC
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
                    ORDER BY `black_list`.`date_id` DESC, `users`.`surname` DESC, `users`.`name` DESC
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
                SELECT 
                    `date_ban`.`date` AS `date_ban`,
                    `today`.`date` AS `date`,
                    `black_list`.`date_id` as `previus_date_id` ,
                    `black_list`.`user_id`, `black_list`.`reason`,
                    `dates_work`.`date_id`, `users`.`surname`,
                    `users`.`name`  
                FROM `black_list`
                    INNER JOIN `dates` AS `date_ban` ON `date_ban`.`id` = `black_list`.`date_id`
                    INNER JOIN `dates_work` ON `dates_work`.`user_id` = `black_list`.`user_id`
                    INNER JOIN `dates` AS `today` ON `today`.`id` = `dates_work`.`date_id`
                    INNER JOIN `users` ON `users`.`id` = `black_list`.`user_id`
                    WHERE `dates_work`.`date_id` = '.$date_id.' AND `dates_work`.`exist` = 1
                    ORDER BY `black_list`.`date_id` ASC , `users`.`surname` ASC, `users`.`name` ASC
            ;');            
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
                SELECT `duty_list`.*,`dates`.`date`, `users`.`surname`, `users`.`name` FROM `duty_list`
					INNER JOIN `dates` ON `dates`.`id` = `duty_list`.`date_id`
                    INNER JOIN `users` ON `users`.`id` = `duty_list`.`user_id`
                    WHERE `duty_list`.`date_id` = '.$date_id.'
            ;');
        }

        public function get_duty_list_all(){
            return $this->query('
                SELECT `duty_list`.*, `dates`.`date`, `users`.`surname`, `users`.`name` FROM `duty_list`
                    INNER JOIN `dates` ON `dates`.`id` = `duty_list`.`date_id`
                    INNER JOIN `users` ON `users`.`id` = `duty_list`.`user_id`
                    ORDER BY `duty_list`.`date_id` DESC, `users`.`surname` DESC, `users`.`name` DESC
            ;');
        }

        public function remove_duty_list($date_id){
            return $this->query('
                DELETE FROM `duty_list`
                    WHERE `duty_list`.`date_id` = '.$date_id.'
            ;');
        }

        /*////////////////// Query for admin ////////////////////*/

        public function get_users_admin(){
            return $this->query('
                SELECT 
                    `users`.`id`,
                    `users`.`name`,
                    `users`.`surname`,
                    `users`.`miss_user`
                FROM `users`
                    ORDER BY `users`.`surname` ASC, `users`.`name` ASC
            ;');
        }

        public function update_users_admin($user_id,  $miss_user){
            $this->form_queries('
                UPDATE `users` 
                    SET `users`.`miss_user` = '.$this->bool_to_sql($miss_user).'
                    WHERE `users`.`id` = '.$user_id.'
            ;');
        }

    }
?>

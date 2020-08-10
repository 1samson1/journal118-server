<?php
    class CheckField{
           
        static function login($login){
            return preg_match('/^([0-9A-Za-z-_\.]+)$/u',$login);
        }

        static function email($email){
            return preg_match('/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u',$email);
        }

        static function pass($pass){
            return isset($pass[0]);
        }

        static function confirm_pass($pass, $repass){
            return $pass == $repass;          
        }
    }
    
?>

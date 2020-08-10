<?php
    class DateControl{        
        static function get_current_date ()
        {
            return date('d.m.Y');
        }

        static function to_date ($time)
        {
            return date('d.m.Y', $time);
        }

        static function get_current_timestamp_date ()
        {
            return  strtotime(self::get_current_date());
        }
    }
?>

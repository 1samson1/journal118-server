<?php
    if(!defined("ENGINE_DIR")){
        define("ENGINE_DIR","../");
    }   

    require_once ENGINE_DIR.'/data/config.php'; // Подключаем глобальный конфиг

    require_once ENGINE_DIR.'/includes/queryDB.php'; // Подключаем файл класса базы данных

    require_once ENGINE_DIR.'/data/dbconfig.php'; // Подключаем конфиг базы данных

    require_once ENGINE_DIR.'/includes/checkFeild.php'; // Подключаем файл класса проверки полей
    
    require_once ENGINE_DIR.'/includes/iterations.php'; // Подключаем файл класса для итерации по спискам
    
    require_once ENGINE_DIR.'/includes/functions.php'; // Подключаем файл общих функций
    
    require_once ENGINE_DIR.'/includes/dateControl.php'; // Подключаем файл обработки дат
    
    
?>

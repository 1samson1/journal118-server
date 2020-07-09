<?
    if(!defined("ENGINE_DIR")){
        define("ENGINE_DIR","../");
    }   

    require_once ENGINE_DIR.'/data/config.php'; // Подключаем глобальный конфиг

    require_once ENGINE_DIR.'/includes/db.php'; // Подключаем файл класса базы данных

    require_once ENGINE_DIR.'/data/dbconfig.php'; // Подключаем конфиг базы данных

    require_once ENGINE_DIR.'/includes/checkFeild.php'; // Подключаем файл класса проверки полей
    
?>
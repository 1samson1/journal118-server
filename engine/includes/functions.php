<?php
    function user_browser($agent) {
        preg_match("/(MSIE|Opera|Firefox|Chrome|Version|Opera Mini|Netscape|Konqueror|SeaMonkey|Camino|Minefield|Iceweasel|K-Meleon|Maxthon)(?:\/| )([0-9.]+)/", $agent, $browser_info); // регулярное выражение, которое позволяет отпределить 90% браузеров
            list(,$browser,$version) = $browser_info; // получаем данные из массива в переменную
            if (preg_match("/Opera ([0-9.]+)/i", $agent, $opera)) return 'Opera '.$opera[1]; // определение _очень_старых_ версий Оперы (до 8.50), при желании можно убрать
            if ($browser == 'MSIE') { // если браузер определён как IE
                    preg_match("/(Maxthon|Avant Browser|MyIE2)/i", $agent, $ie); // проверяем, не разработка ли это на основе IE
                    if ($ie) return $ie[1].' based on IE '.$version; // если да, то возвращаем сообщение об этом
                    return 'IE '.$version; // иначе просто возвращаем IE и номер версии
            }
            if ($browser == 'Firefox') { // если браузер определён как Firefox
                    preg_match("/(Flock|Navigator|Epiphany)\/([0-9.]+)/", $agent, $ff); // проверяем, не разработка ли это на основе Firefox
                    if ($ff) return $ff[1].' '.$ff[2]; // если да, то выводим номер и версию
            }
            if ($browser == 'Opera' && $version == '9.80') return 'Opera '.substr($agent,-5); // если браузер определён как Opera 9.80, берём версию Оперы из конца строки
            if ($browser == 'Version') return 'Safari '.$version; // определяем Сафари
            if (!$browser && strpos($agent, 'Gecko')) return 'Browser based on Gecko'; // для неопознанных браузеров проверяем, если они на движке Gecko, и возращаем сообщение об этом
            return $browser.' '.$version; // для всех остальных возвращаем браузер и версию
    }     
    
    function device(){
        $user_agent = $this->agent(); // взять USER_AGENT пользователя

        $oses = array ('Windows 95','Win95','Windows_95', 'Windows 98', 'Win98', 'Windows NT', 'winNT', 'Windows 2000', 'Windows XP', 'winXP', 'Windows ME', 'winME', 'OpenBSD', 'SunOS', 'Linux', 'Mac_PowerPC', 'Macintosh', 'QNX', 'BeOS', 'OS/2');
        foreach($oses as $os){
            if (substr_count($user_agent, $os) > 0) return 'PC';
        }
        return 'Mobile';
    }
?>
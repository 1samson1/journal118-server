<?php 
    class BeginDutyList {

        public $path;
        public $duty_cache;

        public function __construct($path = ENGINE_DIR.'/cache/nextUsersDuty.json'){
            if(file_exists($path)){
                $this->path = $path;                
                $this->duty_cache = json_decode(file_get_contents($this->path));
            }
            else die('File not exist');
        }

        public function set($next, $previus)
        {
            $this->duty_cache->next = $next;
            $this->duty_cache->previus = $previus;
        }

        public function set_next($next)
        {
            $this->duty_cache->next = $next;
        }

        public function get_next()
        {
            return $this->duty_cache->next;
        }
        
        public function set_previus($previus)
        {
            $this->duty_cache->previus = $previus;
        }

        public function get_previus()
        {
            return $this->duty_cache->previus;
        }

        public function save(){
            file_put_contents($this->path,json_encode($this->duty_cache));
        }
    }
?>
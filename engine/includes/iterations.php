<?php
    class CycleIterator implements Iterator
    {
        private $var = array();
        private $count = 0;
        private $count_cycle = 0;

        public function __construct($array,$count = 2)
        {
            if (is_array($array)) {
                $this->var = $array;
                $this->count = $count;
            }
        }
    
        public function rewind()
        {
            //echo "nперемотка в начало\n";
            reset($this->var);
        }
      
        public function current()
        {
            return current($this->var);
            //echo "текущий: $var\n";
        }
      
        public function get_array()
        {
            return $this->var;
        }

        public function key() 
        {
            return key($this->var);
            //echo "ключ: $var\n";
            
        }
      
        public function next() 
        {
            $var = next($this->var);
            if(!$var && $this->count_cycle < $this->count){
                $this->rewind();
                //echo "следующий cначала\n";
                $this->count_cycle++;              
                return  $this->var; 
            }
            //echo "следующий: $var\n";
            return $var;
        }
      
        public function valid()
        {
            $key = key($this->var);
            return ($key !== NULL && $key !== FALSE);
            //echo "верный: $var\n";            
        }

    }
?>

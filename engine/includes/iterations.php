<?php
    class CycleIterator implements Iterator
    {
        private $var = array();

        public function __construct($array)
        {
            if (is_array($array)) {
                $this->var = $array;
            }
        }
    
        public function rewind()
        {
            //echo "nперемотка в начало\n";
            reset($this->var);
        }
      
        public function current()
        {
            $var = current($this->var);
            //echo "текущий: $var\n";
            return $var;
        }
      
        public function key() 
        {
            $var = key($this->var);
            //echo "ключ: $var\n";
            return $var;
        }
      
        public function next() 
        {
            $var = next($this->var);
            if(!$var){
                $this->rewind();
                //echo "следующий cначала";
                return  $this->var;               
            }
            //echo "следующий: $var\n";
            return $var;
        }
      
        public function valid()
        {
            return true;
            //$key = key($this->var);
            //$var = ($key !== NULL && $key !== FALSE);
            //echo "верный: $var\n";
            //return $var;
        }

    }
?>
<?php
namespace Maxitsa\Abstract;
abstract class AbstractEntity {
    public function __get($arg){
        return property_exists($this, $arg) ? $this->$arg : null;
    }
    public function __set($arg, $value){
        $this->$arg = $value;
    }
}

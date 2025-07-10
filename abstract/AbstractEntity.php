<?php
namespace Maxitsa\Abstract;
abstract class AbstractEntity {
    public function __get($arg){
        return $this->$arg;
    }
    public function __set($arg, $value){
        $this->$arg = $value;
    }
}

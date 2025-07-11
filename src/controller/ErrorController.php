<?php
namespace Maxitsa\Controller;

class ErrorController{
    public function error404(){
       require_once 'src/view/error/404.php';
    }
 }
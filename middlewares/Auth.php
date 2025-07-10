<?php


  function auth()
    {
    $session = \App::getDependency('core', 'Session');
    if (!($session instanceof \Core\Session)) {
        throw new \Exception('Session service not found');
    }
    if(!$session->isset('user')){
       header('Location:  /login');
       exit;
    }
         
    }
    
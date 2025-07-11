<?php
namespace Maxitsa\Service;


use Maxitsa\Repository\TransactionRepository;

class TransactionService {
    private static ?TransactionService $instance = null;
   

    public static function getInstance(): TransactionService {
        if (self::$instance === null) {
            self::$instance = new TransactionService();
        }
        return self::$instance;
    }

 
    
   
}

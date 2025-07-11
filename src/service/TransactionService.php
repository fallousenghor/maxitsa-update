<?php
namespace Maxitsa\Service;

use Maxitsa\Entity\Transaction;
use Maxitsa\Repository\TransactionRepository;

class TransactionService {
    private static ?TransactionService $instance = null;
    private TransactionRepository $transactionRepository;

    private function __construct() {
        $this->transactionRepository = TransactionRepository::getInstance();
    }

    public static function getInstance(): TransactionService {
        if (self::$instance === null) {
            self::$instance = new TransactionService();
        }
        return self::$instance;
    }

 
    
    public function getAllTransactions(): array {
        return $this->transactionRepository->findAll();
    }
}

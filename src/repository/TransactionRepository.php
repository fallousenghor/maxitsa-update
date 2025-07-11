<?php
namespace Maxitsa\Repository;

use Maxitsa\Entity\Transaction;

class TransactionRepository {
    private static ?TransactionRepository $instance = null;
    private static array $transactions = [];

    private function __construct() {}

    public static function getInstance(): TransactionRepository {
        if (self::$instance === null) {
            self::$instance = new TransactionRepository();
        }
        return self::$instance;
    }

    public function save(Transaction $transaction): void {
        self::$transactions[] = $transaction;
    }

    public function findAll(): array {
        return self::$transactions;
    }
}

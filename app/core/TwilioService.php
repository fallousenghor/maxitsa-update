<?php
namespace Maxitsa\Core;

require_once __DIR__ . '/../../vendor/autoload.php';

use Twilio\Rest\Client;

class TwilioService {
    private $client;
    private $from;

    public function __construct() {
        $config = require __DIR__ . '/../config/twilio.php';
        $this->client = new Client($config['sid'], $config['token']);
        $this->from = $config['from'];
    }

    public function sendSms($to, $message) {
        return $this->client->messages->create($to, [
            'from' => $this->from,
            'body' => $message
        ]);
    }
}

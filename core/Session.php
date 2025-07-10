<?php

class Session
{
    private static $instance = null;

    private function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function set($key, $data) {
        $_SESSION[$key] = $data;
    }

    public function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public function unset($key) {
        unset($_SESSION[$key]);
    }

    public function isset($key) {
        return isset($_SESSION[$key]);
    }

    public function destroy($key = null) {
        if ($key !== null) {
            unset($_SESSION[$key]);
        } else {
            session_destroy();
        }
    }
}
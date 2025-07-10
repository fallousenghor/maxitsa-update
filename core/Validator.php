<?php

class Validator
{
    private static array $errors = [];

    public static function isEmail($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function isEmpty($value): bool
    {
        return empty($value);
    }

    public static function addError($key, $message): void
    {
        self::$errors[$key][] = $message;
    }

    public static function getErrors(): array
    {
        return self::$errors;
    }

    public static function isValid(): bool
    {
        return empty(self::$errors);
    }
}

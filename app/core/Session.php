<?php
namespace Maxitsa\Core;
class Session
{
   
    public static function getErrorMessages() {
        return [
           
            'prenom' => 'Le prénom est requis.',
            'nom' => 'Le nom est requis.',
            'telephone' => 'Le téléphone est requis.',
            'adresse' => "L'adresse est requise.",
            'num_identite' => "Le numéro d'identité est requis.",
            'password' => 'Le mot de passe est requis.',
            'password_confirm' => 'Les mots de passe ne correspondent pas.',

           
            'login_invalid' => 'Identifiants invalides.',
            'signup_error' => "Erreur lors de l'inscription.",
            'account_create_error' => "Erreur lors de la création du compte.",

            
            'upload' => "Erreur lors de l'upload des fichiers.",

           
            'transaction_error' => "Erreur lors de la transaction.",
            'solde_insuffisant' => "Solde insuffisant.",
            'transaction_success' => "Transaction effectuée avec succès.",

          
            'field_required' => "Ce champ est requis.",
            'unknown_error' => "Une erreur inconnue est survenue."
        ];
    }

    public static function getErrorMessage($key) {
        $messages = self::getErrorMessages();
        return isset($messages[$key]) ? $messages[$key] : '';
    }

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
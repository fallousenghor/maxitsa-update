<?php
namespace Maxitsa\Core;
class Validator {
    

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

          
            'telephone_format' => 'Le numéro de téléphone doit etre un numero orange.',
            'telephone_unique' => 'Ce numéro de téléphone existe déjà.',
            'identite_format' => "Le numéro d'identité n'est pas valide.",
            'identite_unique' => "Ce numéro d'identité existe déjà.",

           
            'field_required' => "Ce champ est requis.",
            'unknown_error' => "Une erreur inconnue est survenue."
        ];
    }

    public static function getErrorMessage($key) {
        $messages = self::getErrorMessages();
        return isset($messages[$key]) ? $messages[$key] : '';
    }
    private static array $errors = [];

    public static function reset(): void
    {
        self::$errors = [];
    }

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

  
    public static function validatePersonneData($telephone, $num_identite): bool
    {
        self::reset();
        if (!self::isValidTelephone($telephone)) {
            self::addError('telephone', self::getErrorMessage('telephone_format'));
        } elseif (!self::isUniqueTelephone($telephone)) {
            self::addError('telephone', self::getErrorMessage('telephone_unique'));
        }
        if (!self::isValidIdentite($num_identite)) {
            self::addError('num_identite', self::getErrorMessage('identite_format'));
        } elseif (!self::isUniqueIdentite($num_identite)) {
            self::addError('num_identite', self::getErrorMessage('identite_unique'));
        }
        return self::isValid();
    }


    public static function isValidTelephone($telephone): bool
    {
        return preg_match('/^(77|78)\d{7}$/', $telephone);
    }

   
    public static function isValidIdentite($num_identite): bool
    {
        return preg_match('/^(1|2)\d{12}$/', $num_identite);
    }

  
    public static function isUniqueTelephone($telephone): bool
    {
        $db = \Maxitsa\Core\App::getDependency('core', 'Database')->getConnection();
        $stmt = $db->prepare('SELECT COUNT(*) FROM personne WHERE telephone = :telephone');
        $stmt->execute(['telephone' => $telephone]);
        return $stmt->fetchColumn() == 0;
    }

 
    public static function isUniqueIdentite($num_identite): bool
    {
        $db = \Maxitsa\Core\App::getDependency('core', 'Database')->getConnection();
        $stmt = $db->prepare('SELECT COUNT(*) FROM personne WHERE num_identite = :num_identite');
        $stmt->execute(['num_identite' => $num_identite]);
        return $stmt->fetchColumn() == 0;
    }
}

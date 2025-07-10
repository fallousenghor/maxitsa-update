
<?php

class App {
   
    private static array $dependencies = [
       
        'core' => [
            'Database' => \Database::class,
            'Session' => \Core\Session::class,
            'Validator' => \Core\Validator::class,
        ],
       
        'repository' => [
            'PersonneRepository' => \Src\Repository\PersonneRepository::class,
            'CompteRepository' => \Src\Repository\CompteRepository::class,
        ],
      
        'controller' => [
            'UserController' => \Src\Controller\UserController::class,
            'HomeController' => \Src\Controller\HomeController::class,
        ],
     
        'service' => [
            'PersonneService' => \Src\Service\PersonneService::class,
            'CompteService' => \Src\Service\CompteService::class,
            'TransactionService' => \Src\Service\TransactionService::class,
        ],
    ];

   
    public static function getDependency(string $category, string $name)
    {
        if (isset(self::$dependencies[$category][$name])) {
            $class = self::$dependencies[$category][$name];
            if ($category === 'core' && $name === 'Database') {
                return \Database::getInstance();
            }
            if (class_exists($class)) {
                return new $class();
            }
        }
        return null;
    }
}

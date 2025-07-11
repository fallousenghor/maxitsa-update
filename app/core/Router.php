<?php
namespace Maxitsa\Core;

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes = require dirname( __DIR__,2 ). '/routes/route.web.php';
    }

    public function dispatch(string $uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($uri, PHP_URL_PATH);

        $routes = $this->routes[$method] ?? [];

        if (isset($routes[$path])) {
            [$controllerClass, $methodName] = $routes[$path];

            if (class_exists($controllerClass) && method_exists($controllerClass, $methodName)) {
                $controller = new $controllerClass();
                return call_user_func([$controller, $methodName]);
            } else {
                http_response_code(500);
                echo "Méthode ou contrôleur invalide.";
            }
        } else {
            http_response_code(404);
            echo "Page non trouvée.";
        }
    }
}

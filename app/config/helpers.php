<?php

/**
 * Redirige vers une URL en utilisant la BASE_URL du .env
 */
function redirect($path)
{
    $baseUrl = getenv('BASE_URL');
    if (!$baseUrl) {
        $baseUrl = 'http://localhost:8082'; // fallback
    }
    $baseUrl = rtrim($baseUrl, '/;');
    $path = ltrim($path, '/');
    header('Location: ' . $baseUrl . '/' . $path);
    exit;
}

function dd($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    exit;
}

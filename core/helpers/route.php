<?php

function registerRoute($path)
{
    $routesMap = [
        "GET" => [],
        "POST" => [],
    ];

    $routes = require $path;

    foreach ($routes as $route) {
        list($method, $uriPattern) = explode(" ", $route[0]);
        list($controller, $action) = explode("@", $route[1]);
        $middleware = isset($route[2]) ? $route[2] : null;

        // Convert URI pattern to regex and capture parameters
        $regexPattern = '^' . preg_replace('/:\w+/', '([^/]+)', $uriPattern) . '$';
        $regexPattern = str_replace('/', '\/', $regexPattern);
        $routesMap[$method][$regexPattern] = [
            'file' => $controller,
            'func' => $action,
            'middle' => $middleware
        ];
    }

    return $routesMap;
}

function handleRequest($routesMap)
{
    $method = $_SERVER['REQUEST_METHOD'];
    $requestUri = $_SERVER['REQUEST_URI'];
    $parsedUrl = parse_url($requestUri);
    $path = $parsedUrl['path'];

    if (isset($routesMap[$method])) {
        foreach ($routesMap[$method] as $pattern => $route) {
            if (preg_match("~^$pattern$~", $path, $matches)) {
                array_shift($matches); // Remove the full match
                // Registrasi middleware
                registerMiddleware($route['middle']);

                // Pembuatan instance handler
                $classRoute = "Handler\\" . $route['file'];
                if (!class_exists($classRoute)) {
                    die("Class $classRoute not found");
                }

                $handler = new $classRoute;

                // Panggilan metode handler
                $method = $route['func'] ?? null;
                if (!method_exists($handler, $method)) {
                    die("Method $method not found in class $classRoute.");
                }

                call_user_func_array([$handler, $route['func']], $matches);

                return;
            }
        }
    }

    // Handle 404 not found
    http_response_code(404);
    return view("404");
}
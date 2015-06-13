<?php
$router = new Phalcon\Mvc\Router();

$router->add(
    '/api/(.+)',
    array(
        "controller" => "api",
        "action"     => "index",
        "url"        => 1,
    )
);

return $router;

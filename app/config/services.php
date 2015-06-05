<?php
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

$di->set('db', function() use ($config) {
    return new DbAdapter(array(
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->name
    ));
});

$di->set('url', function() use ($config) {
    $url = new UrlProvider();
    $url->setBaseUri($config->application->baseUri);
    return $url;
});

// Views
$di->set('view', function() use ($config) {
    $view = new View();
    $view->setViewsDir(APP_PATH . $config->application->viewsDir);
    $view->registerEngines(array(
        '.volt' => 'Phalcon\Mvc\View\Engine\Volt'
    ));
    return $view;
});

// Session
$di->set('session', function() {
    $session = new Session();
    $session->start();
    return $session;
});

// Database
$di->set('db', function() use ($config) {
    return new DbAdapter(array(
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->name
    ));
});

<?php
use Phalcon\Mvc\View;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Cache\Backend\File as BackFile;
use Phalcon\Cache\Frontend\Data as FrontData;

$di = new FactoryDefault();

$di->set('dispatcher', function() use ($di) {
	$eventsManager = new EventsManager;

	$eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);
	$eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);

	$dispatcher = new Dispatcher;
	$dispatcher->setEventsManager($eventsManager);

	return $dispatcher;
});

$di->set('router', function () use ($config) {
	return include APP_PATH . 'app/config/routes.php';
}, true);

$di->set('url', function() use ($config) {
	$url = new UrlProvider();
	$url->setBaseUri($config->application->baseUri);
	return $url;
});


$di->set('view', function() use ($config) {
	$view = new View();
	$view->setViewsDir(APP_PATH . $config->application->viewsDir);
	$view->registerEngines(array(
		".volt" => 'volt'
	));
	return $view;
});

$di->set('cacheShort', function() {
	$frontCache = new FrontData(array(
		"lifetime" => 3600 * 2
	));
	/*return new BackMemCached($frontCache, array(
		"servers" => array(
			array(
				"host"   => "127.0.0.1",
				"port"   => "11211",
				"weight" => "1"
			)
		)
	));*/
	return new BackFile(
		$frontCache,
		array(
			"cacheDir" => APP_PATH . "cache/short/"
		)
	);
});

$di->set('cacheLong', function() {
	$frontCache = new FrontData(array(
		"lifetime" => 3600 * 24 * 7
	));
	return new BackFile(
		$frontCache,
		array(
			"cacheDir" => APP_PATH . "cache/long/"
		)
	);
});

$di->set('volt', function($view, $di) {
	$volt = new VoltEngine($view, $di);
	$volt->setOptions(array(
		"compiledPath" => APP_PATH . "cache/volt/"
	));
	$compiler = $volt->getCompiler();
	$compiler->addFunction('is_a', 'is_a');
	return $volt;
}, true);

$di->set('db', function() use ($config) {
	$dbclass = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
	return new $dbclass(array(
		'host'     => $config->database->host,
		'username' => $config->database->username,
		'password' => $config->database->password,
		'dbname'   => $config->database->name
	));
});

$di->set('modelsMetadata', function() {
	return new MetaData();
});

$di->set('session', function() {
	$session = new SessionAdapter();
	$session->start();
	return $session;
});

$di->set('flash', function(){
	return new FlashSession(array(
		'error'   => 'alert alert-danger',
		'success' => 'alert alert-success',
		'notice'  => 'alert alert-info',
	));
});

$di->set('elements', function(){
	return new Elements();
});

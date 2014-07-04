<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

//enable debug
$app['debug'] = true;

//register Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

//register UrlGenerator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

//register our Twig Extension
$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    $twig->addExtension(new OssPortal\Twig\OssTwig($app));
    return $twig;
}));

//register form provider
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
));

//set up our API handler
$app['oss.handler'] = $app->share(function ($app) {
    $url        = 'http://localhost:9090';
    $app_key    = '54a51ee4f27cbbcb7a771352b980567f';
    $login      = 'admin';
    $oss_api = new OpenSearchServer\Handler(array('url' => $url, 'key' => $app_key, 'login' => $login));
    return $oss_api;
});

/******** SET UP ROUTES *******/

$app->get	('/',          'OssPortal\\Controllers\\Main::route_home');
$app->get	('/home',	   'OssPortal\\Controllers\\Main::route_home')->bind('home');
$app->get	('/indexes',   'OssPortal\\Controllers\\Indexes::route_indexes')->bind('indexes');
$app->post	('/indexes/new',   'OssPortal\\Controllers\\Indexes::route_newIndex')->bind('new_index');
$app->post	('/indexes/delete','OssPortal\\Controllers\\Indexes::route_deleteIndex')->bind('delete_index');
$app->post	('/indexes/check','OssPortal\\Controllers\\Indexes::route_checkIndex')->bind('check_index');
$app->get	('/search',   'OssPortal\\Controllers\\Search::route_search')->bind('search');


$app->run();
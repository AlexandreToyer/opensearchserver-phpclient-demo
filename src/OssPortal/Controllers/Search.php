<?php
namespace OssPortal\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Search {
    public function route_search(Request $request, Application $app) {
        return $app['twig']->render('search.twig', array(
        ));
    }
}
<?php
namespace OssPortal\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Main {
    public function route_home(Request $request, Application $app) {
        return $app['twig']->render('main.twig', array(
        ));
    }
}
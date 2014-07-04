<?php

namespace OssPortal\Twig;

class OssTwig extends \Twig_Extension
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function getFunctions()
    {
        return array(
        new \Twig_SimpleFunction('is_array', array($this, 'is_array')),
        new \Twig_SimpleFunction('in_array', array($this, 'in_array')),
        new \Twig_SimpleFunction('substr', array($this, 'substr')),
        );
    }
    public function getFilters()
    {
        return array(
        new \Twig_SimpleFilter('json_to_array', array($this, 'jsonToArray')),
        );
    }

    public function in_array($array, $value)
    {
        return in_array($value, $array);
    }

    public function is_array($array)
    {
        return is_array($array);
    }

    public function substr($string, $start, $length)
    {
        return substr($string, $start, $length);
    }

    public function jsonToArray($json) {
        return json_decode($json, true);
    }
    

    public function getName()
    {
        return 'oss_extension';
    }
}

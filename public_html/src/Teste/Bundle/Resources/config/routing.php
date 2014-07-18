<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('exe_form', new Route('/bauf', array(
	'_controller' => 'TesteBundle:Exe_form:index',

	)));


return $collection;

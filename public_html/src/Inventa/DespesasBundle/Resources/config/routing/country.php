<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('country', new Route('/', array(
    '_controller' => 'InventaDespesasBundle:Country:index',
)));

$collection->add('country_show', new Route('/{id}/show', array(
    '_controller' => 'InventaDespesasBundle:Country:show',
)));

$collection->add('country_new', new Route('/new', array(
    '_controller' => 'InventaDespesasBundle:Country:new',
)));

$collection->add('country_create', new Route(
    '/create',
    array('_controller' => 'InventaDespesasBundle:Country:create'),
    array('_method' => 'post')
));

$collection->add('country_edit', new Route('/{id}/edit', array(
    '_controller' => 'InventaDespesasBundle:Country:edit',
)));

$collection->add('country_update', new Route(
    '/{id}/update',
    array('_controller' => 'InventaDespesasBundle:Country:update'),
    array('_method' => 'post|put')
));

$collection->add('country_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'InventaDespesasBundle:Country:delete'),
    array('_method' => 'post|delete')
));

return $collection;

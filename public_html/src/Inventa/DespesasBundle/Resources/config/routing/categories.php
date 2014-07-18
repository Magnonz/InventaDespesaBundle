<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('categories', new Route('/', array(
    '_controller' => 'InventaDespesasBundle:Categories:index',
)));

$collection->add('categories_show', new Route('/{id}/show', array(
    '_controller' => 'InventaDespesasBundle:Categories:show',
)));

$collection->add('categories_new', new Route('/new', array(
    '_controller' => 'InventaDespesasBundle:Categories:new',
)));

$collection->add('categories_create', new Route(
    '/create',
    array('_controller' => 'InventaDespesasBundle:Categories:create'),
    array('_method' => 'post')
));

$collection->add('categories_edit', new Route('/{id}/edit', array(
    '_controller' => 'InventaDespesasBundle:Categories:edit',
)));

$collection->add('categories_update', new Route(
    '/{id}/update',
    array('_controller' => 'InventaDespesasBundle:Categories:update'),
    array('_method' => 'post|put')
));

$collection->add('categories_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'InventaDespesasBundle:Categories:delete'),
    array('_method' => 'post|delete')
));

return $collection;

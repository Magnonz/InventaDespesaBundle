<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('suppliers', new Route('/', array(
    '_controller' => 'InventaDespesasBundle:Suppliers:index',
)));

$collection->add('suppliers_show', new Route('/{id}/show', array(
    '_controller' => 'InventaDespesasBundle:Suppliers:show',
)));

$collection->add('suppliers_new', new Route('/new', array(
    '_controller' => 'InventaDespesasBundle:Suppliers:new',
)));

$collection->add('suppliers_create', new Route(
    '/create',
    array('_controller' => 'InventaDespesasBundle:Suppliers:create'),
    array('_method' => 'post')
));

$collection->add('suppliers_edit', new Route('/edit/{id}', array(
    '_controller' => 'InventaDespesasBundle:Suppliers:edit',
)));

$collection->add('suppliers_update', new Route(
    '/{id}/update',
    array('_controller' => 'InventaDespesasBundle:Suppliers:update'),
    array('_method' => 'post|put')
));

$collection->add('suppliers_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'InventaDespesasBundle:Suppliers:delete'),
    array('_method' => 'post|delete')
));

return $collection;

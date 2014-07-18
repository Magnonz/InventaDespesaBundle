<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('currencies', new Route('/', array(
    '_controller' => 'InventaDespesasBundle:Currencies:index',
)));

$collection->add('currencies_show', new Route('/{id}/show', array(
    '_controller' => 'InventaDespesasBundle:Currencies:show',
)));

$collection->add('currencies_new', new Route('/new', array(
    '_controller' => 'InventaDespesasBundle:Currencies:new',
)));

$collection->add('currencies_create', new Route(
    '/create',
    array('_controller' => 'InventaDespesasBundle:Currencies:create'),
    array('_method' => 'post')
));

$collection->add('currencies_edit', new Route('/edit/{id}', array(
    '_controller' => 'InventaDespesasBundle:Currencies:edit',
)));

$collection->add('currencies_update', new Route(
    '/{id}/update',
    array('_controller' => 'InventaDespesasBundle:Currencies:update'),
    array('_method' => 'post|put')
));

$collection->add('currencies_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'InventaDespesasBundle:Currencies:delete'),
    array('_method' => 'post|delete')
));

return $collection;

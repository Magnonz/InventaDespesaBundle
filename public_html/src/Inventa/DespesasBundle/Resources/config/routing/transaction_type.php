<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('transaction_type', new Route('/', array(
    '_controller' => 'InventaDespesasBundle:TransactionType:index',
)));

$collection->add('transaction_type_show', new Route('/{id}/show', array(
    '_controller' => 'InventaDespesasBundle:TransactionType:show',
)));

$collection->add('transaction_type_new', new Route('/new', array(
    '_controller' => 'InventaDespesasBundle:TransactionType:new',
)));

$collection->add('transaction_type_create', new Route(
    '/create',
    array('_controller' => 'InventaDespesasBundle:TransactionType:create'),
    array('_method' => 'post')
));

$collection->add('transaction_type_edit', new Route('/{id}/edit', array(
    '_controller' => 'InventaDespesasBundle:TransactionType:edit',
)));

$collection->add('transaction_type_update', new Route(
    '/{id}/update',
    array('_controller' => 'InventaDespesasBundle:TransactionType:update'),
    array('_method' => 'post|put')
));

$collection->add('transaction_type_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'InventaDespesasBundle:TransactionType:delete'),
    array('_method' => 'post|delete')
));

return $collection;

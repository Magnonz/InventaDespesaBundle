<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('transactions', new Route('/', array(
    '_controller' => 'InventaDespesasBundle:Transactions:index',
)));

$collection->add('transactions_show', new Route('/{id}/show', array(
    '_controller' => 'InventaDespesasBundle:Transactions:show',
)));

$collection->add('transactions_new', new Route('/new', array(
    '_controller' => 'InventaDespesasBundle:Transactions:new',
)));

$collection->add('transactions_create', new Route(
    '/create',
    array('_controller' => 'InventaDespesasBundle:Transactions:create'),
    array('_method' => 'post')
));

$collection->add('transactions_edit', new Route('/edit/{id}', array(
    '_controller' => 'InventaDespesasBundle:Transactions:edit',
)));

$collection->add('transactions_update', new Route(
    '/{id}/update',
    array('_controller' => 'InventaDespesasBundle:Transactions:update'),
    array('_method' => 'post|put')
));

$collection->add('transactions_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'InventaDespesasBundle:Transactions:delete'),
    array('_method' => 'post|delete')
));

$collection->add('transactions_expenses', new Route(
    '/{id}/{supplier_id}/{currency}/transactions_expenses',
    array('_controller' => 'InventaDespesasBundle:Transactions:transactions_expenses',

)));

$collection->add('transaction_paid' , new Route(
    '/{transaction_id}/{expenses_id}',
    array('_controller'=>'InventaDespesasBundle:Transactions:transactions_paid')));


return $collection;

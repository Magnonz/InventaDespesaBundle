<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('expenses_files', new Route('/', array(
    '_controller' => 'InventaDespesasBundle:ExpensesFiles:index',
)));

$collection->add('expenses_files_show', new Route('/{id}/show', array(
    '_controller' => 'InventaDespesasBundle:ExpensesFiles:show',
)));

$collection->add('expenses_files_new', new Route('/new', array(
    '_controller' => 'InventaDespesasBundle:ExpensesFiles:new',
)));

$collection->add('expenses_files_create', new Route(
    '/create',
    array('_controller' => 'InventaDespesasBundle:ExpensesFiles:create'),
    array('_method' => 'post')
));

$collection->add('expenses_files_edit', new Route('/{id}/edit', array(
    '_controller' => 'InventaDespesasBundle:ExpensesFiles:edit',
)));

$collection->add('expenses_files_update', new Route(
    '/{id}/update',
    array('_controller' => 'InventaDespesasBundle:ExpensesFiles:update'),
    array('_method' => 'post|put')
));

$collection->add('expenses_files_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'InventaDespesasBundle:ExpensesFiles:delete'),
    array('_method' => 'post|delete')
));

return $collection;

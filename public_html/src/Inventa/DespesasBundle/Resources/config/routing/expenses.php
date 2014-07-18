<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;


$collection= new RouteCollection();

$collection->add('expenses', new Route('/', array(
    '_controller' => 'InventaDespesasBundle:Expenses:showall',
)));


$collection->add('expenses_new', new Route('/new', array(
    '_controller' => 'InventaDespesasBundle:Expenses:new',
)));

$collection->add('expenses_edit', new Route('/edit/{id}', array(
    '_controller' => 'InventaDespesasBundle:Expenses:edit',
)));

$collection->add('expenses_update', new Route(
    '/{id}/update',
    array('_controller' => 'InventaDespesasBundle:Expenses:update'),
    array('_method' => 'post|put')
));

$collection->add('expenses_delete', new Route('/{id}/delete', array(
    '_controller' => 'InventaDespesasBundle:Expenses:delete',
)));

$collection->add('expenses_show', new Route('/{id}/show', array(
    '_controller' => 'InventaDespesasBundle:Expenses:show',
)));

return $collection;
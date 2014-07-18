<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('company', new Route('/', array(
    '_controller' => 'InventaDespesasBundle:Company:index',
)));

$collection->add('company_show', new Route('/{id}/show', array(
    '_controller' => 'InventaDespesasBundle:Company:show',
)));

$collection->add('company_new', new Route('/new', array(
    '_controller' => 'InventaDespesasBundle:Company:new',
)));

$collection->add('company_create', new Route(
    '/create',
    array('_controller' => 'InventaDespesasBundle:Company:create'),
    array('_method' => 'post')
));

$collection->add('company_edit', new Route('/{id}/edit', array(
    '_controller' => 'InventaDespesasBundle:Company:edit',
)));

$collection->add('company_update', new Route(
    '/{id}/update',
    array('_controller' => 'InventaDespesasBundle:Company:update'),
    array('_method' => 'post|put')
));

$collection->add('company_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'InventaDespesasBundle:Company:delete'),
    array('_method' => 'post|delete')
));

return $collection;

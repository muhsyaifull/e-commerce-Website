<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'c_barang::index');
// $routes->get('/shoppingcard', 'c_barang::shoppingcard');
// $routes->get('/', 'HomeController::index');
$routes->get('/shop', 'c_barang::index');
$routes->get('/cart', 'c_cart::index');
$routes->get('/cart/add/(:num)', 'c_cart::addToCart/$1');
$routes->get('/cart/delete/(:num)', 'c_cart::deleteFromCart/$1');
$routes->get('/cart/tambah-barang/(:num)', 'c_cart::tambahBarang/$1');
$routes->get('/cart/kurangi-barang/(:num)', 'c_cart::kurangiBarang/$1');
$routes->get('/checkout', 'c_cart::checkout');
$routes->post('/order', 'c_cart::order');
$routes->get('/berhasil', 'c_cart::berhasil');

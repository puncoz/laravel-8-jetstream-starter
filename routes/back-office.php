<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->get(
    '/',
    function () {
        return redirect()->route('back.dashboard');
    }
);

$router->get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');

$router->group(
    ['namespace' => 'Users'],
    function (Router $router) {
        $router->resource('users', 'UsersController');
    }
);


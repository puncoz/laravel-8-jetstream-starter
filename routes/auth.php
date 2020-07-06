<?php

/** @var Router $router */

// Authentication Routes
use Illuminate\Routing\Router;

$router->group(
    ['prefix' => 'login', 'as' => 'login'],
    function () use ($router) {
        $router->get('/', 'LoginController@showLoginForm')->name('');
        $router->post('/', 'LoginController@login')->name('.post');
    }
);
$router->post('/logout', 'LoginController@logout')->name('logout');

$router->group(
    ['prefix' => 'verify', 'as' => 'verification'],
    function () use ($router) {
        $router->get('/', 'VerificationController@show')->name('.notice');
        $router->get('/resend', 'VerificationController@resend')->name('.resend');
        $router->get('/success', 'VerificationController@success')->name('.success');
        $router->get('/{id}/{hash}', 'VerificationController@verify')->name('.verify');
    }
);

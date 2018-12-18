<?php

$app->get('/translate/{lang}', 'TranslationController:switch');

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/regulations', 'RegulationsController:index')->setName('regulations');

$app->group('', function () {

    $this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
    $this->post('/auth/signup', 'AuthController:postSignUp');

    $this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin', 'AuthController:postSignIn');

})->add(new \App\Middleware\GuestMiddleware($container));

$app->group('', function () {

    $this->get('/logout', 'LogoutController:index')->setName('auth.logout');
    $this->get('/users/{user}', 'UsersController:index')->setName('users');
    $this->get('/dashboard', 'StartController:index')->setName('dashboard');
    $this->get('/settings', 'SettingsController:index')->setName('settings');

})->add(new \App\Middleware\AuthMiddleware($container));

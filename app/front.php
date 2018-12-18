<?php

/*
 *
 *
 * Container with translator
 * Translator from laravel framework
 *
 *
 */
$container['translator'] = function($container) {

    $fallback = $container['settings']['translations']['fallback'];

    $loader = new \Illuminate\Translation\FileLoader(
        new \Illuminate\Filesystem\Filesystem(), $container['settings']['translations']['path']
    );

    $translator = new \Illuminate\Translation\Translator($loader, $_SESSION['lang'] ?? $fallback);
    $translator->setFallback($fallback);

    return $translator;
};


/*
 *
 *
 * Container with twig template
 * Twig template from symfony framework
 *
 *
 */
$container['view'] = function($container) {

    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
        'debug' => true,
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    $view->addExtension(new \App\Views\Extensions\TranslationExtension($container['translator']));
    $view->addExtension(new Twig_Extension_Debug());

    $view->getEnvironment()->addGlobal('session', $_SESSION);
    $view->getEnvironment()->addGlobal('flash', $container->flash);
    $view->getEnvironment()->addGlobal('auth', [
        'check' => $container->auth->check(),
        'user'  => $container->auth->user(),
    ]);

    return $view;

};



/*
 *
 * Controller for non page handler
 *
 */
$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        $container->view->render($response, '404.twig');
        return $response->withStatus(404);
    };
};

/*
 *
 *
 * Container for flash messages
 *
 *
 */
$container['flash'] = function ($container) {
    return new \Slim\Flash\Messages();
};


/*
 *
 *
 * Containers with controller's
 *
 *
 */
$container['auth'] = function ($container) {
    return new \App\Auth\Auth;
};

$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};

$container['UsersController'] = function ($container) {
    return new \App\Controllers\About\UsersController($container);
};

$container['LogoutController'] = function ($container) {
    return new \App\Controllers\Auth\LogoutController($container);
};

$container['StartController'] = function ($container) {
    return new \App\Controllers\Dashboard\StartController($container);
};

$container['SettingsController'] = function ($container) {
    return new \App\Controllers\Dashboard\SettingsController($container);
};

$container['TranslationController'] = function ($container) {
    return new \App\Controllers\TranslationController($container);
};

$container['AuthController'] = function ($container) {
    return new \App\Controllers\Auth\AuthController($container);
};

$container['RegulationsController'] = function ($container) {
    return new \App\Controllers\About\RegulationsController($container);
};

$container['validator'] = function ($container) {
    return new \App\Validation\Validator;
};


/*
 *
 *
 * Adding to app specific classes
 *
 *
 */
$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));


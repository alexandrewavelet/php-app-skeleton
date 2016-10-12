<?php

$injector = new \Auryn\Injector;

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');

$injector->alias('MyApp\Templates\Renderer', 'MyApp\Templates\TwigRenderer');
$injector->delegate('Twig_Environment', function() use ($injector, $environment) {
    $options = ($environment === 'development') ? [ 'debug' => true, ] : [];
    $twig = new Twig_Environment(
        new Twig_Loader_Filesystem(dirname(__DIR__).'/templates'),
        $options
    );
    $twig->addExtension(new Twig_Extensions_Extension_Text());

    $app = [
        'server' => [
            'host' => 'http://'.$_SERVER['HTTP_HOST'],
            'pathname' => ($_SERVER['REQUEST_URI'] !== '/') ? $_SERVER['REQUEST_URI'] : '',
        ],
        'assets' => [
            'main' => [
                'css'   => '/assets/css/main.css',
                'icons' => 'http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css',
                'js'    => [
                    'global'  => '/assets/js/main.js',
                ],
            ],
            'jquery' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js',
            'foundation' => [
                'css' => 'https://cdn.jsdelivr.net/foundation/6.2.3/foundation.min.css',
                'js'  => 'https://cdn.jsdelivr.net/foundation/6.2.3/foundation.min.js',
            ],
        ],
    ];
    $twig->addGlobal('app', $app);

    if ($environment === 'development') {
        $twig->addExtension(new Twig_Extension_Debug());
    }

    return $twig;
});

return $injector;

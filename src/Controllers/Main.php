<?php

namespace MyApp\Controllers;

use Http\Request;
use Http\Response;
use PhpUtils\Types\Collection;
use PhpUtils\Types\Str;
use MyApp\Templates\Renderer;

class Main
{
    private $request;
    private $response;
    private $renderer;

    public function __construct(Request $request, Response $response, Renderer $renderer)
    {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
    }

    public function welcome($name)
    {
        $data = [
            'name' => $name,
        ];

        $this->response->setContent(
            $this->renderer->render('Index', $data)
        );
    }
}

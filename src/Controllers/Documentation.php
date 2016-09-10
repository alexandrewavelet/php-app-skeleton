<?php

namespace TsrDoc\Controllers;

use Http\Request;
use Http\Response;
use TsrDoc\Templates\Renderer;

class Documentation
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

    public function homepage()
    {

        $data = [
            'name' => $this->request->getParameter('name', 'John Doe'),
        ];

        $this->response->setContent(
            $this->renderer->render('Homepage', $data)
        );
    }

    public function folder($path)
    {
        $data = [
            'path' => $path,
        ];

        $this->response->setContent(
            $this->renderer->render('Folder', $data)
        );
    }
}

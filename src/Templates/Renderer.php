<?php

namespace MyApp\Templates;

interface Renderer
{
    public function render($template, $data = []);
}

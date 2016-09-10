<?php

namespace TsrDoc\Templates;

interface Renderer
{
    public function render($template, $data = []);
}

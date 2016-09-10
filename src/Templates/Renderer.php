<?php

namespace Skeleton\Templates;

interface Renderer
{
    public function render($template, $data = []);
}

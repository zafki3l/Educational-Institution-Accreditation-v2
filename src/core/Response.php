<?php

namespace Core;

class Response
{
    public function __construct(
        public string $module,
        public string $view,
        public string $layout,
        public array $data = []
    ) {}
}
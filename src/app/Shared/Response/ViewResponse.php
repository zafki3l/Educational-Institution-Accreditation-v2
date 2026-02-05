<?php

namespace App\Shared\Response;

use Core\Response;

class ViewResponse extends Response
{
    public function __construct(string $module, string $view, string $layout, array $data = [])
    {
        return parent::__construct($module, $view, $layout, $data);
    }
}
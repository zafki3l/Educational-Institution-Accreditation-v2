<?php

namespace Core;

use Illuminate\Container\Container;

abstract class ServiceProvider
{
    abstract function register(Container $container): void;
}
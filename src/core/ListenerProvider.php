<?php

namespace Core;

abstract class ListenerProvider
{
    abstract static function register(): array;
}
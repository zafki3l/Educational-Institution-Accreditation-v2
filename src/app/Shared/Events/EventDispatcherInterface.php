<?php

namespace App\Shared\Events;

interface EventDispatcherInterface {
    public function dispatch(object $event): void;
    public function addListener(string $eventClass, callable $listener): void;
}
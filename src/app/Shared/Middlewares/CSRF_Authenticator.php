<?php

namespace App\Shared\Middlewares;

use Exception;

class CSRF_Authenticator
{
    public function handle(): void
    {
        if (!$this->isTokenSet()) {
            throw new Exception('Token is not set!');
        }

        $sessionToken = (string) $_SESSION['CSRF-token'];
        $formToken = (string) $_POST['CSRF-token'];

        if (!$this->verifyToken($sessionToken, $formToken)) {
            throw new Exception('Token invalid!');
        }

        if ($this->isTokenExpire()) {
            throw new Exception('Token invalid');
        }
    }

    private function isTokenSet(): bool
    {
        return isset($_SESSION['CSRF-token'], $_POST['CSRF-token']);
    }
    
    private function verifyToken(string $sessionToken, string $formToken): bool
    {
        return hash_equals($sessionToken, $formToken);
    }

    private function isTokenExpire(): bool
    {
        return time() >= $_SESSION['token-expire'];
    }
}
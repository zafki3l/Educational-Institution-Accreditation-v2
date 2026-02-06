<?php

function isAuth(): bool
{
    return isset($_SESSION['auth_user']);
}
<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;

class LoginController
{
    protected function redirectTo(): string
    {
        return RouteServiceProvider::redirectTo();
    }


}

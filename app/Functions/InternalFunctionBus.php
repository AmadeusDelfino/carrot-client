<?php

namespace App\Functions;


use Adelf\Config\Config;
use App\Abstracts\AFunctionBus;

class InternalFunctionBus extends AFunctionBus
{
    protected function functions() : array
    {
        return Config::instance()->get('functions.internal', []);
    }
}
<?php

namespace App\Functions;


use Adelf\Config\Config;
use App\Abstracts\AFunctionBus;

class ExternalFunctionBus extends AFunctionBus
{
    protected function functions() : array
    {
        return Config::instance()->get('functions.external', []);
    }
}
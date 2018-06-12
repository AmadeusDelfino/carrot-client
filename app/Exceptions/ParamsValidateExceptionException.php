<?php

namespace App\Exceptions;


class ParamsValidateExceptionException extends \Exception
{
    protected $errors = [];

    public function addErrors(array $errors) : ParamsValidateExceptionException
    {
        $this->errors = array_merge($errors, $this->errors);

        return $this;
    }

    public function getErrors() : array
    {
        return $this->errors;
    }

}
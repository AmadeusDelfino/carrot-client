<?php

namespace App\Abstracts;


use App\Exceptions\ParamsValidateExceptionException;
use App\Functions\ParamsValidator;

abstract class AFunction
{
    protected $name = '';

    protected $description = '';

    protected $parameters = [];

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $params
     * @return mixed
     * @throws ParamsValidateExceptionException
     */
    public function handle(array $params)
    {
        $this->validateParams($params);

        return $this->result($params);
    }

    /**
     * @param array $params
     * @return bool
     * @throws ParamsValidateExceptionException
     */
    private function validateParams(array $params)
    {
        return (new ParamsValidator())($params, $this->getParameters());
    }

    abstract protected function result($params);
}
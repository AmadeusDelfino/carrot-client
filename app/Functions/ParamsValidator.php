<?php

namespace App\Functions;


use App\Exceptions\ParamsValidateExceptionException;

class ParamsValidator
{
    protected $errors = [];

    /**
     * @param array $params
     * @param array $properties
     * @return bool
     * @throws ParamsValidateExceptionException
     */
    public function __invoke(array $params, array $properties)
    {
        $this->evaluateErrors($params, $properties);
        $this->throwExceptionIfHasErrors();

        return true;
    }

    /**
     * @throws ParamsValidateExceptionException
     */
    public function throwExceptionIfHasErrors()
    {
        if(count($this->errors) > 0) {
            $exception = new ParamsValidateExceptionException();
            $exception->addErrors($this->errors);

            throw $exception;
        }
    }

    private function evaluateErrors($params, $properties)
    {
        foreach($properties as $key=>$values) {
            if(isset($values['required']) && $values['required'] === true && !array_key_exists($key, $params)) {
                $this->addError($key,'Is required.');
            }
        }
    }

    private function addError(string $name, string $error)
    {
        $this->errors[$name][] = $error;
    }
}
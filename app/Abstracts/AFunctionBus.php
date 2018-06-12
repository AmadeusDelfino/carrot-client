<?php

namespace App\Abstracts;


use App\Exceptions\FunctionClassDoesNotExistsException;
use App\Exceptions\FunctionDoesNotExistsInBusException;

abstract class AFunctionBus
{
    protected $functions = [];

    /**
     * AFunctionBus constructor.
     * @throws FunctionClassDoesNotExistsException
     */
    public function __construct()
    {
        $this->functions = $this->makeFunctionsArray($this->functions());
    }

    /**
     * @param array $functions
     * @return array
     * @throws FunctionClassDoesNotExistsException
     */
    private function makeFunctionsArray(array $functions) : array
    {
        $arr = [];
        foreach($functions as $function) {
            try{
                /** @var AFunction $class */
                $class = new $function();
            } catch (\Exception $e) {
                throw new FunctionClassDoesNotExistsException();
            }

            $arr[$class->getName()] = get_class($class);
            unset($class);
        }

        return $arr;
    }

    abstract protected function functions() : array;

    private function functionExists($function)
    {
        return array_key_exists($function, $this->functions);
    }

    /**
     * @param string $function
     * @param array $params
     * @return mixed
     * @throws FunctionDoesNotExistsInBusException
     */
    public function __invoke(string $function, array $params = [])
    {
        if($this->functionExists($function)) {
            return (new $this->functions[$function])->handle($params);
        }

        throw new FunctionDoesNotExistsInBusException();
    }
}

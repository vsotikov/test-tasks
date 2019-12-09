<?php
declare(strict_types = 1);

namespace Application\Model;

/**
 * EntityAbstract
 *
 * @package Application\Model
 */
abstract class EntityAbstract
{
    /**
     * NotMappedData
     *
     * @var array
     */
    private $notMappedData = [];

    /**
     * Return data that was not mapped to object properties
     *
     * @return array
     */
    public function getNotMappedData(): array
    {
        return $this->notMappedData;
    }

    /**
     * Fill object with data
     *
     * @param array $data
     * @return void
     */
    public function exchangeArray(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));

            if (method_exists($this, $method)) {
                $reflection = new \ReflectionMethod(static::class, $method);

                /** @var \ReflectionParameter $parameter */
                $parameter = current($reflection->getParameters());

                if ($parameter && $parameter->getType()) {
                    if (!($value === null && $parameter->allowsNull())) {
                        settype($value, $parameter->getType()->getName());
                    }
                }

                $this->$method($value);
            } else {
                // no method
                $this->notMappedData[$key] = $value;
            }
        }
    }

    /**
     * Convert object to array
     *
     * @return array
     * @throws \ReflectionException
     */
    public function toArray(): array
    {
        $result = [];

        $properties = (new \ReflectionClass($this))->getProperties();

        foreach ($properties as $property) {
            $method = 'get' . ucfirst($property->getName());

            if (method_exists($this, $method)) {
                $key = (string)preg_replace_callback(
                    '/([A-Z])/',
                    static function ($matches) {
                        return '_' . strtolower($matches[1]);
                    },
                    $property->getName()
                );

                $result[$key] = $this->$method();
            }
        }

        return $result;
    }
}
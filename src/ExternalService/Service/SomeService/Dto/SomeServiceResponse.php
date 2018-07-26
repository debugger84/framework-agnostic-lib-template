<?php

namespace ExternalService\Service\SomeService\Dto;

use ExternalService\ExternalServiceResponseInterface;

class SomeServiceResponse implements ExternalServiceResponseInterface
{
    /**
     * @var int
     */
    private $count = 0;

    /**
     * Fill fields of the object from array
     * @param array $data
     * @return $this
     */
    public function exchangeArray(array $data)
    {
        if (isset($data['count'])) {
            $this->count = (int) $data['count'];
        }
        return $this;
    }

    /**
     * Copy all fields of the request as array
     * @return array
     */
    public function copyToArray(): array
    {
        return [
            'count' => $this->count
        ];
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return $this
     */
    public function setCount(int $count)
    {
        $this->count = $count;
        return $this;
    }
}
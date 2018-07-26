<?php

namespace ExternalService;

interface ExternalServiceResponseInterface
{
    /**
     * Fill fields of the object from array
     * @param array $data
     * @return $this
     */
    public function exchangeArray(array $data);

    /**
     * Copy all fields of the response as array
     * @return array
     */
    public function copyToArray(): array;
}
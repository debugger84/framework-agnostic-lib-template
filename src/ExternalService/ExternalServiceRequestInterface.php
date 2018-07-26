<?php

namespace ExternalService;

use ExternalService\Exception\ExternalServiceException;

interface ExternalServiceRequestInterface
{
    /**
     * Copy all fields of the request as array
     * @return array
     */
    public function copyToArray(): array;
}
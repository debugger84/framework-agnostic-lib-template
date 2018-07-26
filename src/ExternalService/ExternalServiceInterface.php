<?php

namespace ExternalService;

use ExternalService\Exception\ExternalServiceException;

interface ExternalServiceInterface
{
    /**
     * Call external service to get data
     * @param ExternalServiceRequestInterface $request
     * @return ExternalServiceResponseInterface
     * @throws ExternalServiceException
     */
    public function get(ExternalServiceRequestInterface $request): ExternalServiceResponseInterface;
}
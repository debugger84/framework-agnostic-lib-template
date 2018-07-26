<?php


namespace ExternalService\Service\SomeService;

use ExternalService\Exception\ExternalServiceException;
use ExternalService\ExternalServiceInterface;
use ExternalService\ExternalServiceRequestInterface;
use ExternalService\ExternalServiceResponseInterface;
use ExternalService\Service\SomeService\Dto\SomeServiceResponse;

class SomeService implements ExternalServiceInterface
{
    private $host;
    private $user;
    private $password;

    /**
     * @param $host
     * @param $user
     * @param $password
     */
    public function __construct($host, $user, $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Call external service to get data
     * @param ExternalServiceRequestInterface $request
     * @return ExternalServiceResponseInterface
     * @throws ExternalServiceException
     */
    public function get(ExternalServiceRequestInterface $request): ExternalServiceResponseInterface
    {
        //some code to get data from the current external service to the $data variable
        //If something went wrong - throws ExternalServiceException
        $data = ['count' => 10];
        return (new SomeServiceResponse())->exchangeArray($data);
    }
}
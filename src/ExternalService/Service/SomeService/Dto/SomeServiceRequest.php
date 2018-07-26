<?php

namespace ExternalService\Service\SomeService\Dto;

use ExternalService\ExternalServiceRequestInterface;

class SomeServiceRequest implements ExternalServiceRequestInterface
{
    /**
     * @var string
     */
    private $searchString = '';

    /**
     * Copy all fields of the request as array
     * @return array
     */
    public function copyToArray(): array
    {
        return [
            'q' => $this->searchString
        ];
    }

    /**
     * @return string
     */
    public function getSearchString(): string
    {
        return $this->searchString;
    }

    /**
     * @param string $searchString
     * @return $this
     */
    public function setSearchString(string $searchString)
    {
        $this->searchString = $searchString;
        return $this;
    }
}
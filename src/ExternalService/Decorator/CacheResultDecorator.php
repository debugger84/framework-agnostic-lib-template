<?php

namespace ExternalService\Decorator;

use DateTime;
use ExternalService\Exception\ExternalServiceException;
use ExternalService\ExternalServiceInterface;
use ExternalService\ExternalServiceRequestInterface;
use ExternalService\ExternalServiceResponseInterface;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;

class CacheResultDecorator implements ExternalServiceInterface
{
    /**
     * @var ExternalServiceInterface
     */
    private $externalService;

    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * CacheResultDecorator constructor.
     * @param ExternalServiceInterface $externalService
     * @param CacheItemPoolInterface $cache
     */
    public function __construct(ExternalServiceInterface $externalService, CacheItemPoolInterface $cache)
    {
        $this->externalService = $externalService;
        $this->cache = $cache;
    }

    /**
     * Call external service to get data
     * @param ExternalServiceRequestInterface $request
     * @return ExternalServiceResponseInterface
     * @throws ExternalServiceException
     */
    public function get(ExternalServiceRequestInterface $request): ExternalServiceResponseInterface
    {
        $cacheKey = $this->getCacheKey($request->copyToArray());
        try {
            $cacheItem = $this->cache->getItem($cacheKey);
        } catch (InvalidArgumentException $e) {
            throw new ExternalServiceException($e->getMessage());
        }
        if ($cacheItem->isHit()) {
            return unserialize($cacheItem->get());
        }

        $response = $this->externalService->get($request);

        $cacheItem
            ->set(serialize($response))
            ->expiresAt(
                (new DateTime())->modify('+1 day')
            );
        $this->cache->save($cacheItem);

        return $response;
    }

    private function getCacheKey(array $input)
    {
        return hash('sha256', json_encode($input));
    }
}
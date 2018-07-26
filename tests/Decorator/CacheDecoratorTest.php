<?php


namespace ExternalService\Tests\Decorator;


use ExternalService\Decorator\CacheResultDecorator;
use ExternalService\Service\SomeService\Dto\SomeServiceRequest;
use ExternalService\Service\SomeService\Dto\SomeServiceResponse;
use ExternalService\Service\SomeService\SomeService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class CacheDecoratorTest extends TestCase
{
    public function testDecorator()
    {
        $someService = new SomeService('aa', 'bb', 'ccc');
        $cache = new ArrayAdapter();
        $decorator = new CacheResultDecorator($someService, $cache);

        $request = new SomeServiceRequest();
        $request->setSearchString('aaa');
        /** @var SomeServiceResponse $response */
        $response = $decorator->get($request);

        $this->assertInstanceOf(SomeServiceResponse::class, $response);
        $this->assertEquals(10, $response->getCount());
        $this->assertEquals(1, count($cache->getValues()));

        $responseFromCache = $decorator->get($request);
        $this->assertInstanceOf(SomeServiceResponse::class, $responseFromCache);
        $this->assertEquals(10, $responseFromCache->getCount());
        $this->assertEquals(1, count($cache->getValues()));
    }
}
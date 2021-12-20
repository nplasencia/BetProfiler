<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Model\Factory;

use Auret\BetProfiler\Model\ExchangeRequest;
use Auret\BetProfiler\Model\Factory\ExchangeRequestFactory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ExchangeRequestFactoryTest extends TestCase
{
    private ExchangeRequestFactory $exchangeRequestFactory;

    protected function setUp(): void
    {
        $this->exchangeRequestFactory = new ExchangeRequestFactory();
    }

    /**
     * @covers ExchangeRequestFactory::create
     */
    public function testCreateSuccess(): void
    {
        $exchangeName = 'Exchange Name';
        $exchangeUrl = 'https://exchange.url.com';

        $result = $this->exchangeRequestFactory->create($this->getEncodedJson($exchangeName, $exchangeUrl));
        $expected = new ExchangeRequest($exchangeName, $exchangeUrl);
        $this->assertEquals($expected, $result);
    }

    /**
     * @covers ExchangeRequestFactory::create
     */
    public function testThrowErrorIfPropertiesAreNotPresent(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $encodedJson = '{}';

        $this->exchangeRequestFactory->create($encodedJson);
    }

    private function getEncodedJson(string $name, string $url): string
    {
        return sprintf('{"name":"%s", "url":"%s"}', $name, $url);
    }
}
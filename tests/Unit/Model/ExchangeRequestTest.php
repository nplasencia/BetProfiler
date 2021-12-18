<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Model;

use Auret\BetProfiler\Model\ExchangeRequest;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;

final class ExchangeRequestTest extends TestCase
{
    /**
     * @covers ExchangeRequest::__construct
     * @return void
     */
    public function testCreateSuccess(): void
    {
        $exchangeName = 'Exchange Name';
        $exchangeUrl = 'https://exchange.url.com';

        $exchangeRequest = new ExchangeRequest($this->getDecodedJson($exchangeName, $exchangeUrl));
        $this->assertEquals($exchangeName, $exchangeRequest->getName());
        $this->assertEquals($exchangeUrl, $exchangeRequest->getUrl());
    }

    /**
     * @covers ExchangeRequest::__construct
     * @return void
     */
    public function testThrowErrorIfPropertiesAreNotPresent(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $decodedJson = new stdClass();

        new ExchangeRequest($decodedJson);
    }

    private function getDecodedJson(string $name, string $url): stdClass
    {
        $decodedJson = new stdClass();
        $decodedJson->name = $name;
        $decodedJson->url = $url;

        return $decodedJson;
    }
}
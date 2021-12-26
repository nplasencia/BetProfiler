<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Model\Factory;

use Auret\BetProfiler\Model\BookmakerRequest;
use Auret\BetProfiler\Model\Factory\BookmakerRequestFactory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class BookmakerRequestFactoryTest extends TestCase
{
    private BookmakerRequestFactory $bookmakerRequestFactory;

    protected function setUp(): void
    {
        $this->bookmakerRequestFactory = new BookmakerRequestFactory();
    }

    /**
     * @covers BookmakerRequestFactory::create
     */
    public function testCreateSuccess(): void
    {
        $bookmakerName = 'Bookmaker Name';
        $bookmakerUrl = 'https://bookmaker.url.com';

        $result = $this->bookmakerRequestFactory->create($this->getEncodedJson($bookmakerName, $bookmakerUrl));
        $expected = new BookmakerRequest($bookmakerName, $bookmakerUrl);
        $this->assertEquals($expected, $result);
    }

    /**
     * @covers bookmakerRequestFactory::create
     */
    public function testThrowErrorIfPropertiesAreNotPresent(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $encodedJson = '{}';

        $this->bookmakerRequestFactory->create($encodedJson);
    }

    private function getEncodedJson(string $name, string $url): string
    {
        return sprintf('{"name":"%s", "url":"%s"}', $name, $url);
    }
}
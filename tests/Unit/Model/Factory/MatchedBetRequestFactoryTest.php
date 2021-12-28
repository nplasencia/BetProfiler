<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Model\Factory;

use Auret\BetProfiler\Model\Factory\MatchedBetRequestFactory;
use Auret\BetProfiler\Model\MatchedBetRequest;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class MatchedBetRequestFactoryTest extends TestCase
{
    private MatchedBetRequestFactory $matchedBetRequestFactory;

    protected function setUp(): void
    {
        $this->matchedBetRequestFactory = new MatchedBetRequestFactory();
    }

    /**
     * @covers MatchedBetRequestFactory::create
     */
    public function testCreateSuccess(): void
    {
        $bookmakerId = 1;
        $exchangeId = 2;
        $eventId = 3;
        $marketTypeId = 4;
        $betType = 'Normal';
        $betMode = 'Underlay';
        $notes = 'Lorem ipsum';

        $encodedJson = $this->getEncodedJson($bookmakerId, $exchangeId, $eventId, $marketTypeId, $betType, $betMode, $notes);
        $result = $this->matchedBetRequestFactory->create($encodedJson);
        $expected = new MatchedBetRequest($bookmakerId, $exchangeId, $eventId, $marketTypeId, $betType, $betMode, $notes);
        $this->assertEquals($expected, $result);
    }

    /**
     * @covers MatchedBetRequestFactory::create
     */
    public function testThrowErrorIfPropertiesAreNotPresent(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $encodedJson = '{}';

        $this->matchedBetRequestFactory->create($encodedJson);
    }

    private function getEncodedJson(
       int $bookmakerId,
       int $exchangeId,
       int $eventId,
       int $marketTypeId,
       string $betType,
       string $betMode,
       string $notes
    ): string
    {
        $jsonTemplate = '{"bookmakerId":%d, "exchangeId":%d, "eventId":%d, "marketTypeId":%d, "betType":"%s", "betMode":"%s", "notes":"%s"}';
        return sprintf($jsonTemplate, $bookmakerId, $exchangeId, $eventId, $marketTypeId, $betType, $betMode, $notes);
    }
}
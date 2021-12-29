<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Interactor;

use Auret\BetProfiler\Common\MatchedBetModeEnum;
use Auret\BetProfiler\Common\MatchedBetTypeEnum;
use Auret\BetProfiler\Entity\Bookmaker;
use Auret\BetProfiler\Entity\Event;
use Auret\BetProfiler\Entity\Exchange;
use Auret\BetProfiler\Entity\MarketType;
use Auret\BetProfiler\Entity\MatchedBet;
use Auret\BetProfiler\Gateway\MatchedBetGatewayInterface;
use Auret\BetProfiler\Interactor\MatchedBetInteractor;
use Auret\BetProfiler\Model\Factory\RequestFactoryInterface;
use Auret\BetProfiler\Model\MatchedBetRequest;
use PHPUnit\Framework\TestCase;
use ValueError;

final class MatchedBetInteractorTest extends TestCase
{
    private MatchedBetInteractor $matchedBetInteractor;

    private MatchedBetGatewayInterface $matchedBetGateway;
    private RequestFactoryInterface $requestFactory;

    protected function setUp(): void
    {
        $this->matchedBetGateway = $this->createMock(MatchedBetGatewayInterface::class);
        $this->requestFactory = $this->createMock(RequestFactoryInterface::class);

        $this->matchedBetInteractor = new MatchedBetInteractor($this->matchedBetGateway, $this->requestFactory);
    }

    /**
     * @covers BookmakerInteractor::add
     */
    public function testAddNewBookmaker_success(): void
    {
        $bookmakerId = 1;
        $exchangeId = 2;
        $eventId = 3;
        $marketTypeId = 4;
        $betType = 'Normal';
        $betMode = 'Underlay';
        $notes = 'Lorem Ipsum';

        $jsonRequest = $this->getEncodedJson($bookmakerId, $exchangeId, $eventId, $marketTypeId, $betType, $betMode, $notes);
        $matchedBetRequest = new MatchedBetRequest($bookmakerId, $exchangeId, $eventId, $marketTypeId, $betType, $betMode, $notes);
        $this->requestFactory->expects($this->once())->method('create')->with($jsonRequest)->willReturn($matchedBetRequest);
        $this->matchedBetGateway->expects($this->once())->method('add')
           ->with($this->getExpectedMatchedBet($bookmakerId, $exchangeId, $eventId, $marketTypeId, $betType, $betMode, $notes));

        $this->matchedBetInteractor->add($jsonRequest);
    }

    /**
     * @covers BookmakerInteractor::add
     */
    public function testAddNewBookmaker_expectsErrorWhenBetTypeIsNotValidEnum(): void
    {
        $bookmakerId = 1;
        $exchangeId = 2;
        $eventId = 3;
        $marketTypeId = 4;
        $betType = 'someWeirdBetType';
        $betMode = 'Underlay';
        $notes = 'Lorem Ipsum';

        $jsonRequest = $this->getEncodedJson($bookmakerId, $exchangeId, $eventId, $marketTypeId, $betType, $betMode, $notes);
        $matchedBetRequest = new MatchedBetRequest($bookmakerId, $exchangeId, $eventId, $marketTypeId, $betType, $betMode, $notes);
        $this->requestFactory->expects($this->once())->method('create')->with($jsonRequest)->willReturn($matchedBetRequest);
        $this->matchedBetGateway->expects($this->never())->method('add');

        $this->expectException(ValueError::class);

        $this->matchedBetInteractor->add($jsonRequest);
    }

    /**
     * @covers BookmakerInteractor::add
     */
    public function testAddNewBookmaker_expectsErrorWhenBetModeIsNotValidEnum(): void
    {
        $bookmakerId = 1;
        $exchangeId = 2;
        $eventId = 3;
        $marketTypeId = 4;
        $betType = 'Normal';
        $betMode = 'SomeWeirdBetMode';
        $notes = 'Lorem Ipsum';

        $jsonRequest = $this->getEncodedJson($bookmakerId, $exchangeId, $eventId, $marketTypeId, $betType, $betMode, $notes);
        $matchedBetRequest = new MatchedBetRequest($bookmakerId, $exchangeId, $eventId, $marketTypeId, $betType, $betMode, $notes);
        $this->requestFactory->expects($this->once())->method('create')->with($jsonRequest)->willReturn($matchedBetRequest);
        $this->matchedBetGateway->expects($this->never())->method('add');

        $this->expectException(ValueError::class);

        $this->matchedBetInteractor->add($jsonRequest);
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

    private function getExpectedMatchedBet(
       int $bookmakerId,
       int $exchangeId,
       int $eventId,
       int $marketTypeId,
       string $betType,
       string $betMode,
       string $notes
    ): MatchedBet
    {
        return new MatchedBet(
            new Bookmaker($bookmakerId, null, null),
            new Exchange($exchangeId, null, null),
            new Event($eventId, null, null, null),
            new MarketType($marketTypeId, null, null),
            MatchedBetTypeEnum::from($betType),
            MatchedBetModeEnum::from($betMode),
            $notes
        );
    }
}

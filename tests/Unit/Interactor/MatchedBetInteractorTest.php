<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Interactor;

use Auret\BetProfiler\Common\BetResultEnum;
use Auret\BetProfiler\Common\MatchedBetModeEnum;
use Auret\BetProfiler\Common\MatchedBetTypeEnum;
use Auret\BetProfiler\Controller\BackBetController;
use Auret\BetProfiler\Controller\EventController;
use Auret\BetProfiler\Controller\LayBetController;
use Auret\BetProfiler\Entity\BackBet;
use Auret\BetProfiler\Entity\Event;
use Auret\BetProfiler\Entity\LayBet;
use Auret\BetProfiler\Entity\MarketType;
use Auret\BetProfiler\Entity\MatchedBet;
use Auret\BetProfiler\Exception\MatchedBetRequestValidationException;
use Auret\BetProfiler\Gateway\MatchedBetGatewayInterface;
use Auret\BetProfiler\Interactor\MatchedBetInteractor;
use Auret\BetProfiler\Model\MatchedBetRequest;
use Auret\BetProfiler\Tests\Utils\BackBetUtils;
use Auret\BetProfiler\Tests\Utils\EventUtils;
use Auret\BetProfiler\Tests\Utils\LayBetUtils;
use DateTime;
use PHPUnit\Framework\TestCase;

final class MatchedBetInteractorTest extends TestCase
{
    private MatchedBetInteractor $matchedBetInteractor;
    private BackBetController $backBetController;
    private LayBetController $layBetController;
    private EventController $eventController;
    private MatchedBetGatewayInterface $matchedBetGateway;

    private BackBetUtils $backBetUtils;
    private LayBetUtils $layBetUtils;
    private EventUtils $eventUtils;

    protected function setUp(): void
    {
        $this->backBetUtils = new BackBetUtils();
        $this->layBetUtils = new LayBetUtils();
        $this->eventUtils = new EventUtils();

        $this->backBetController = $this->createMock(BackBetController::class);
        $this->layBetController = $this->createMock(LayBetController::class);
        $this->eventController = $this->createMock(EventController::class);
        $this->matchedBetGateway = $this->createMock(MatchedBetGatewayInterface::class);

        $this->matchedBetInteractor = new MatchedBetInteractor(
            $this->matchedBetGateway, $this->backBetController, $this->layBetController, $this->eventController
        );
    }

    /**
     * @covers MatchedBetInteractor::add
     */
    public function testAddNewMatchedBet_success(): void
    {
        $bookmakerId = 1;
        $backBetStake = 1.23;
        $backBetOdds = 4.56;
        $backBetReturn = 9.92;
        $backBetProfit = 100;
        $backBetResult = BetResultEnum::WIN;
        $storedBackBetId = 2;

        $exchangeId = 99;
        $layBetStake = 23.1;
        $layBetOdds = 9.87;
        $layBetLiability = 190;
        $layBetReturn = 0.92;
        $layBetProfit = 102;
        $layBetResult = BetResultEnum::LOSE;
        $storedLayBetId = 7;

        $eventName = 'Nauzet vs Tezuan';
        $eventDateTime = new DateTime();
        $eventTypeId = 99;
        $storedEventId = 876;

        $bet = 'Draw';
        $marketTypeId = 4;
        $betType = 'Normal';
        $betMode = 'Underlay';
        $notes = 'Lorem Ipsum';

        $backBetRequest = $this->backBetUtils->getBackBetRequest($bookmakerId, $backBetStake, $backBetOdds, $backBetReturn, $backBetProfit, $backBetResult);
        $storedBackBet = $this->backBetUtils->getBackBet($bookmakerId, $storedBackBetId, $backBetStake, $backBetOdds, $backBetReturn, $backBetProfit, $backBetResult);
        $this->backBetController->expects($this->once())->method('add')->with($backBetRequest)->willReturn($storedBackBet);

        $layBetRequest = $this->layBetUtils->getLayBetRequest($exchangeId, $layBetStake, $layBetOdds, $layBetLiability, $layBetReturn, $layBetProfit, $layBetResult);
        $storedLayBet = $this->layBetUtils->getLayBet($exchangeId, $storedLayBetId, $layBetStake, $layBetOdds, $layBetLiability, $layBetReturn, $layBetProfit, $layBetResult);
        $this->layBetController->expects($this->once())->method('add')->with($layBetRequest)->willReturn($storedLayBet);

        $eventRequest = $this->eventUtils->getEventRequest($eventName, $eventDateTime, $eventTypeId);
        $storedEvent = $this->eventUtils->getEvent($storedEventId, $eventName, $eventDateTime, $eventTypeId);
        $this->eventController->expects($this->once())->method('add')->with($eventRequest)->willReturn($storedEvent);

        $this->matchedBetGateway->expects($this->once())->method('add')->with($this->getExpectedMatchedBet(null, $storedBackBet, $storedLayBet, $storedEvent, $bet, $marketTypeId, $betType, $betMode, $notes));

        $matchedBetRequest = new MatchedBetRequest($backBetRequest, $layBetRequest, $eventRequest, $bet, $marketTypeId, $betType, $betMode, $notes);
        $this->matchedBetInteractor->add($matchedBetRequest);
    }

    /**
     * @covers MatchedBetInteractor::add
     */
    public function testAddNewMatchedBet_expectsErrorWhenBetTypeIsNotValidEnum(): void
    {
        $bet = 'Nauzet wins';
        $marketTypeId = 4;
        $betType = 'someWeirdBetType';
        $betMode = 'Underlay';
        $notes = 'Lorem Ipsum';

        $this->expectException(MatchedBetRequestValidationException::class);
        $this->expectExceptionMessage('Undefined BetType');

        $this->backBetController->expects($this->never())->method('add');
        $this->layBetController->expects($this->never())->method('add');
        $this->eventController->expects($this->never())->method('add');
        $this->matchedBetGateway->expects($this->never())->method('add');

        $backBetRequest = $this->backBetUtils->getBackBetRequest(1, 2, 3, 4, 5, BetResultEnum::WIN);
        $layBetRequest = $this->layBetUtils->getLayBetRequest(6, 7, 8, 9, 10, 11, BetResultEnum::LOSE);
        $eventRequest = $this->eventUtils->getEventRequest('EventName', new DateTime(), 3);

        $matchedBetRequest = new MatchedBetRequest($backBetRequest, $layBetRequest, $eventRequest, $bet, $marketTypeId, $betType, $betMode, $notes);
        $this->matchedBetInteractor->add($matchedBetRequest);
    }

    /**
     * @covers MatchedBetInteractor::add
     */
    public function testAddNewMatchedBet_expectsErrorWhenBetModeIsNotValidEnum(): void
    {
        $bet = 'Nauzet wins';
        $marketTypeId = 4;
        $betType = 'Normal';
        $betMode = 'SomeWeirdBetMode';
        $notes = 'Lorem Ipsum';

        $this->expectException(MatchedBetRequestValidationException::class);
        $this->expectExceptionMessage('Undefined BetMode');

        $this->backBetController->expects($this->never())->method('add');
        $this->layBetController->expects($this->never())->method('add');
        $this->eventController->expects($this->never())->method('add');
        $this->matchedBetGateway->expects($this->never())->method('add');

        $backBetRequest = $this->backBetUtils->getBackBetRequest(1, 2, 3, 4, 5, BetResultEnum::WIN);
        $layBetRequest = $this->layBetUtils->getLayBetRequest(6, 7, 8, 9, 10, 11, BetResultEnum::LOSE);
        $eventRequest = $this->eventUtils->getEventRequest('EventName', new DateTime(), 3);

        $matchedBetRequest = new MatchedBetRequest($backBetRequest, $layBetRequest, $eventRequest, $bet, $marketTypeId, $betType, $betMode, $notes);
        $this->matchedBetInteractor->add($matchedBetRequest);
    }

    /**
     * @covers MatchedBetInteractor::add
     */
    public function testAddNewMatchedBet_expectsErrorWhenBackBetResultAndLayBetResultAreTheSame(): void
    {
        $backBetResult = BetResultEnum::WIN;
        $layBetResult = BetResultEnum::WIN;

        $bet = 'Nauzet wins';
        $marketTypeId = 4;
        $betType = 'Normal';
        $betMode = 'Underlay';
        $notes = 'Lorem Ipsum';

        $this->expectException(MatchedBetRequestValidationException::class);

        $this->backBetController->expects($this->never())->method('add');
        $this->layBetController->expects($this->never())->method('add');
        $this->eventController->expects($this->never())->method('add');
        $this->matchedBetGateway->expects($this->never())->method('add');

        $backBetRequest = $this->backBetUtils->getBackBetRequest(1, 2, 3, 4, 5, $backBetResult);
        $layBetRequest = $this->layBetUtils->getLayBetRequest(6, 7, 8, 9, 10, 11, $layBetResult);
        $eventRequest = $this->eventUtils->getEventRequest('EventName', new DateTime(), 3);

        $matchedBetRequest = new MatchedBetRequest($backBetRequest, $layBetRequest, $eventRequest, $bet, $marketTypeId, $betType, $betMode, $notes);
        $this->matchedBetInteractor->add($matchedBetRequest);
    }

    /**
     * @covers MatchedBetInteractor::deleteById
     */
    public function testDeleteById(): void
    {
        $matchedBetId = 1;

        $this->matchedBetGateway->expects($this->once())->method('delete')->with($matchedBetId);
        $this->matchedBetInteractor->deleteById($matchedBetId);
    }

    private function getExpectedMatchedBet(
        ?int $id,
        BackBet $backBet,
        LayBet $layBet,
        Event $event,
        string $bet,
        int $marketTypeId,
        string $betType,
        string $betMode,
        string $notes
    ): MatchedBet
    {
        $marketType = new MarketType($marketTypeId, null, null);
        $betTypeEnum = MatchedBetTypeEnum::from($betType);
        $betModeEnum = MatchedBetModeEnum::from($betMode);

        return new MatchedBet($id, $backBet, $layBet, $event, $bet, $marketType, $betTypeEnum, $betModeEnum, $notes);
    }
}

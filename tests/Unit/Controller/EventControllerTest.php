<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Controller;

use Auret\BetProfiler\Controller\EventController;
use Auret\BetProfiler\Gateway\EventGatewayInterface;
use Auret\BetProfiler\Tests\Utils\EventUtils;
use DateTime;
use PHPUnit\Framework\TestCase;

final class EventControllerTest extends TestCase
{
    private EventController $eventController;
    private EventGatewayInterface $eventGateway;

    private EventUtils $eventUtils;

    protected function setUp(): void
    {
        $this->eventUtils = new EventUtils();

        $this->eventGateway = $this->createMock(EventGatewayInterface::class);
        $this->eventController = new EventController($this->eventGateway);
    }

    /**
     * @covers EventController::add
     */
    public function testAdd_success(): void
    {
        $eventName = 'Nauzet vs Tezuan';
        $eventDateTime = new DateTime();
        $eventTypeId = 99;

        $expectedEventToStore = $this->eventUtils->getEvent(null, $eventName, $eventDateTime, $eventTypeId);
        $expectedEventStored = $this->eventUtils->getEvent(1, $eventName, $eventDateTime, $eventTypeId);
        $this->eventGateway->expects($this->once())->method('add')->with($expectedEventToStore)->willReturn($expectedEventStored);

        $request = $this->eventUtils->getEventRequest($eventName, $eventDateTime, $eventTypeId);
        $this->eventController->add($request);
    }
}
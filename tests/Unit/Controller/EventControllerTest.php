<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Controller;

use Auret\BetProfiler\Controller\EventController;
use Auret\BetProfiler\Entity\Event;
use Auret\BetProfiler\Entity\EventType;
use Auret\BetProfiler\Gateway\EventGatewayInterface;
use Auret\BetProfiler\Model\EventRequest;
use DateTime;
use PHPUnit\Framework\TestCase;

final class EventControllerTest extends TestCase
{
    private EventController $eventController;
    private EventGatewayInterface $eventGateway;

    protected function setUp(): void
    {
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

        $expectedEventToStore = $this->getEvent(null, $eventName, $eventDateTime, $eventTypeId);
        $expectedEventStored = $this->getEvent(1, $eventName, $eventDateTime, $eventTypeId);
        $this->eventGateway->expects($this->once())->method('add')->with($expectedEventToStore)->willReturn($expectedEventStored);

        $request = new EventRequest($eventName, $eventDateTime, $eventTypeId);
        $this->eventController->add($request);
    }

    private function getEvent(?int $id, string $eventName, DateTime $eventDateTime, int $eventTypeId): Event
    {
        $eventType = new EventType($eventTypeId, null, null);
        return new Event($id, $eventName, $eventDateTime, $eventType);
    }
}
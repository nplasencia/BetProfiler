<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Interactor;

use Auret\BetProfiler\Entity\EventType;
use Auret\BetProfiler\Gateway\EventTypeGatewayInterface;
use Auret\BetProfiler\Interactor\EventTypeInteractor;
use Auret\BetProfiler\Model\EventTypeRequest;
use PHPUnit\Framework\TestCase;

final class EventTypeInteractorTest extends TestCase
{
    private EventTypeInteractor $interactor;
    private EventTypeGatewayInterface $gateway;

    protected function setUp(): void
    {
        $this->gateway = $this->createMock(EventTypeGatewayInterface::class);
        $this->interactor = new EventTypeInteractor($this->gateway);
    }

    /**
     * @covers EventTypeInteractor::getAll
     */
    public function testGetOnlyOneEventType(): void
    {
        $eventType = new EventType(1, 'Event Description', 'event_code');

        $this->gateway->expects($this->once())->method('getAll')
           ->willReturn([$eventType]);

        $expected = [$eventType];
        $this->assertEquals($expected, $this->interactor->getAll());
    }

    /**
     * @covers EventTypeInteractor::getAll
     */
    public function testGetManyEventTypes(): void
    {
        $eventType1 = new EventType(1, 'EventType Name 1', 'event_code_1');
        $eventType2 = new EventType(2, 'EventType Name 2', 'event_code_2');
        $eventType3 = new EventType(3, 'EventType Name 3', 'event_code_3');

        $this->gateway->expects($this->once())->method('getAll')
           ->willReturn([$eventType1, $eventType2, $eventType3]);

        $expected = [$eventType1, $eventType2, $eventType3];
        $this->assertEquals( $expected, $this->interactor->getAll() );
    }

    /**
     * @covers EventTypeInteractor::add
     */
    public function testAddNewEventType(): void
    {
        $eventTypeName = 'EventType Name';
        $eventTypeCode = 'event_code';

        $this->gateway->expects($this->once())->method('add')->with(new EventType(null, $eventTypeName, $eventTypeCode));

        $eventTypeRequest = new EventTypeRequest($eventTypeName, $eventTypeCode);
        $this->interactor->add($eventTypeRequest);
    }

    /**
     * @covers EventTypeInteractor::deleteById
     */
    public function testDeleteById(): void
    {
        $eventTypeId = 1;

        $this->gateway->expects($this->once())->method('delete')->with($eventTypeId);
        $this->interactor->deleteById($eventTypeId);
    }

    /**
     * @covers EventTypeInteractor::updateById
     */
    public function testUpdateById(): void
    {
        $eventTypeId = 99;
        $newEventTypeName = 'New EventType Name';
        $newEventTypeCode = 'new_event_code';

        $this->gateway->expects($this->once())->method('update')
           ->with($eventTypeId, new EventType($eventTypeId, $newEventTypeName, $newEventTypeCode));

        $eventTypeRequest = new EventTypeRequest($newEventTypeName, $newEventTypeCode);
        $this->interactor->updateById($eventTypeId, $eventTypeRequest);
    }

    /**
     * @covers EventTypeInteractor::getById
     */
    public function testGetById(): void
    {
        $eventTypeId = 99;
        $eventTypeName = 'New EventType Name';
        $eventTypeCode = 'new_event_code';

        $this->gateway->expects($this->once())->method('get')
           ->willReturn(new EventType($eventTypeId, $eventTypeName, $eventTypeCode));

        $expected = new EventType($eventTypeId, $eventTypeName, $eventTypeCode);
        $this->assertEquals($expected, $this->interactor->getById($eventTypeId));
    }
}

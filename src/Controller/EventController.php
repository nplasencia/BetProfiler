<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Controller;

use Auret\BetProfiler\Entity\Event;
use Auret\BetProfiler\Entity\EventType;
use Auret\BetProfiler\Gateway\EventGatewayInterface;
use Auret\BetProfiler\Model\EventRequest;

class EventController
{
    public function __construct(
        private EventGatewayInterface $eventGateway
    ) {}

    public function add(EventRequest $request): Event
    {
        $event = $this->getEventFromRequest($request);
        return $this->eventGateway->add($event);
    }

    private function getEventFromRequest(EventRequest $request): Event
    {
        return new Event(
            null,
            $request->getName(),
            $request->getDateTime(),
            new EventType($request->getEventTypeId(), null, null)
        );
    }
}
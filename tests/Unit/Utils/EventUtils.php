<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Utils;

use Auret\BetProfiler\Entity\Event;
use Auret\BetProfiler\Entity\EventType;
use Auret\BetProfiler\Model\EventRequest;
use DateTime;

final class EventUtils
{
    public function getEvent(?int $id, string $eventName, DateTime $eventDateTime, int $eventTypeId): Event
    {
        $eventType = new EventType($eventTypeId, null, null);
        return new Event($id, $eventName, $eventDateTime, $eventType);
    }

    public function getEventRequest(string $eventName, DateTime $eventDateTime, int $eventTypeId): EventRequest
    {
        return new EventRequest($eventName, $eventDateTime, $eventTypeId);
    }
}
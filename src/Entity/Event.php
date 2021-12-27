<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use DateTime;

final class Event
{
    private string $eventName;
    private DateTime $eventDateTime;
    private EventType $eventType;
}
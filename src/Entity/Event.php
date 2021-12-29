<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use DateTime;

final class Event
{
    public function __construct(
        private ?int $id,
        private ?string $eventName,
        private ?DateTime $eventDateTime,
        private ?EventType $eventType
    ) {}
}
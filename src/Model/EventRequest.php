<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Model;

use DateTime;

final class EventRequest implements RequestInterface
{
    public function __construct(
        private string $name,
        private DateTime $dateTime,
        private int $eventTypeId
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    public function getEventTypeId(): int
    {
        return $this->eventTypeId;
    }
}
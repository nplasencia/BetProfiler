<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use DateTime;

final class Event
{
    public function __construct(
        private ?int $id,
        private ?string $name,
        private ?DateTime $dateTime,
        private ?EventType $type
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDateTime(): ?DateTime
    {
        return $this->dateTime;
    }

    public function getType(): ?EventType
    {
        return $this->type;
    }
}
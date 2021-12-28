<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

final class EventType
{
    public function __construct(
        private string $name,
        private string $code
    ) {}
}
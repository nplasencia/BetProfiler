<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Gateway;

use Auret\BetProfiler\Entity\EventType;

interface EventTypeGatewayInterface
{
    public function add(EventType $eventType): void;

    public function delete(int $id): void;

    public function update(int $id, EventType $eventType): void;

    /**
     * @return EventType[]
     */
    public function getAll(): array;

    public function get(int $id): EventType;
}
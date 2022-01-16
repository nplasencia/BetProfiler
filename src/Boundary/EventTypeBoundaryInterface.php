<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Boundary;

use Auret\BetProfiler\Entity\EventType;
use Auret\BetProfiler\Model\EventTypeRequest;

interface EventTypeBoundaryInterface
{
    public function add(EventTypeRequest $request): void;

    public function deleteById(int $id): void;

    public function updateById(int $id, EventTypeRequest $request): void;

    /**
     * @return EventType[]
     */
    public function getAll(): array;

    public function getById(int $id): EventType;
}
<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Interactor;

use Auret\BetProfiler\Boundary\EventTypeBoundaryInterface;
use Auret\BetProfiler\Entity\EventType;
use Auret\BetProfiler\Gateway\EventTypeGatewayInterface;
use Auret\BetProfiler\Model\EventTypeRequest;

final class EventTypeInteractor implements EventTypeBoundaryInterface
{
    public function __construct(
        private EventTypeGatewayInterface $eventTypeGateway
    ) {}

    public function add(EventTypeRequest $request): void
    {
        $eventType = new EventType(null, $request->getName(), $request->getCode());
        $this->eventTypeGateway->add($eventType);
    }

    public function deleteById(int $id): void
    {
        $this->eventTypeGateway->delete($id);
    }

    public function updateById(int $id, EventTypeRequest $request): void
    {
        $eventType = new EventType($id, $request->getName(), $request->getCode());
        $this->eventTypeGateway->update($id, $eventType);
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        return $this->eventTypeGateway->getAll();
    }

    public function getById(int $id): EventType
    {
        return $this->eventTypeGateway->get($id);
    }
}
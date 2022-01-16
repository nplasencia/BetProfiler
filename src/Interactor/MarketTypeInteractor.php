<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Interactor;

use Auret\BetProfiler\Boundary\MarketTypeBoundaryInterface;
use Auret\BetProfiler\Entity\MarketType;
use Auret\BetProfiler\Gateway\MarketTypeGatewayInterface;
use Auret\BetProfiler\Model\MarketTypeRequest;

final class MarketTypeInteractor implements MarketTypeBoundaryInterface
{
    public function __construct(
        private MarketTypeGatewayInterface $marketTypeGateway
    ) {}

    public function add(MarketTypeRequest $request): void
    {
        $marketType = new MarketType(null, $request->getName(), $request->getCode());
        $this->marketTypeGateway->add($marketType);
    }

    public function deleteById(int $id): void
    {
        $this->marketTypeGateway->delete($id);
    }

    public function updateById(int $id, MarketTypeRequest $request): void
    {
        $marketType = new MarketType($id, $request->getName(), $request->getCode());
        $this->marketTypeGateway->update($id, $marketType);
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        return $this->marketTypeGateway->getAll();
    }

    public function getById(int $id): MarketType
    {
        return $this->marketTypeGateway->get($id);
    }
}
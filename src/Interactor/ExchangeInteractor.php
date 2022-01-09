<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Interactor;

use Auret\BetProfiler\Boundary\ExchangeBoundaryInterface;
use Auret\BetProfiler\Entity\Exchange;
use Auret\BetProfiler\Gateway\ExchangeGatewayInterface;
use Auret\BetProfiler\Model\ExchangeRequest;

final class ExchangeInteractor implements ExchangeBoundaryInterface
{
    public function __construct(
        private ExchangeGatewayInterface $exchangeGateway,
    ) {}

    public function add(ExchangeRequest $request): void
    {
        $exchange = new Exchange(null, $request->getName(), $request->getUrl());
        $this->exchangeGateway->add($exchange);
    }

    public function deleteById(int $id): void
    {
        $this->exchangeGateway->delete($id);
    }

    public function updateById(int $id, ExchangeRequest $request): void
    {
        $exchange = new Exchange($id, $request->getName(), $request->getUrl());
        $this->exchangeGateway->update($id, $exchange);
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        return $this->exchangeGateway->getAll();
    }

    public function getById(int $id): Exchange
    {
        return $this->exchangeGateway->get($id);
    }
}
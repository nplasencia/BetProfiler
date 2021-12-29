<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Interactor;

use Auret\BetProfiler\Boundary\ExchangeBoundaryInterface;
use Auret\BetProfiler\Entity\Exchange;
use Auret\BetProfiler\Gateway\ExchangeGatewayInterface;
use Auret\BetProfiler\Model\ExchangeRequest;
use Auret\BetProfiler\Model\Factory\RequestFactoryInterface;

final class ExchangeInteractor implements ExchangeBoundaryInterface
{
    public function __construct(
        private ExchangeGatewayInterface $exchangeGateway,
        private RequestFactoryInterface $requestFactory
    ) {}

    /**
     * @inheritDoc
     */
    public function add(string $jsonRequest): void
    {
        /** @var ExchangeRequest $exchangeRequest */
        $exchangeRequest = $this->requestFactory->create($jsonRequest);
        $exchange = new Exchange(null, $exchangeRequest->getName(), $exchangeRequest->getUrl());
        $this->exchangeGateway->add($exchange);
    }

    public function deleteById(int $id): void
    {
        $this->exchangeGateway->delete($id);
    }

    /**
     * @inheritDoc
     */
    public function updateById(int $id, string $jsonRequest): void
    {
        /** @var ExchangeRequest $exchangeRequest */
        $exchangeRequest = $this->requestFactory->create($jsonRequest);
        $exchange = new Exchange($id, $exchangeRequest->getName(), $exchangeRequest->getUrl());
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
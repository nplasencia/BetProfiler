<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Interactor;

use Auret\BetProfiler\Boundary\ExchangeBoundaryInterface;
use Auret\BetProfiler\Entity\Exchange;
use Auret\BetProfiler\Gateway\ExchangeGatewayInterface;
use Auret\BetProfiler\Model\ExchangeRequest;
use Auret\BetProfiler\Model\Factory\RequestFactoryInterface;
use JsonException;

final class ExchangeInteractor implements ExchangeBoundaryInterface
{
    private ExchangeGatewayInterface $exchangeGateway;
    private RequestFactoryInterface $requestFactory;

    public function __construct(ExchangeGatewayInterface $exchangeGateway, RequestFactoryInterface $requestFactory)
    {
        $this->exchangeGateway = $exchangeGateway;
        $this->requestFactory = $requestFactory;
    }

    /**
     * @inheritDoc
     */
    public function add(string $jsonRequest): void
    {
        /** @var ExchangeRequest $exchangeRequest */
        $exchangeRequest = $this->requestFactory->create($jsonRequest);
        $exchange = new Exchange($exchangeRequest->getName(), $exchangeRequest->getUrl());
        $this->exchangeGateway->add($exchange);
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $id): void
    {
        $this->exchangeGateway->delete($id);
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        return $this->exchangeGateway->getAll();
    }
}
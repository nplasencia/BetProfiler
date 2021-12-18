<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Interactor;

use Auret\BetProfiler\Boundary\ExchangeBoundaryInterface;
use Auret\BetProfiler\Entity\Exchange;
use Auret\BetProfiler\Gateway\ExchangeGatewayInterface;

class ExchangeInteractor implements ExchangeBoundaryInterface
{
    private ExchangeGatewayInterface $exchangeGateway;

    public function __construct(ExchangeGatewayInterface $exchangeGateway)
    {
        $this->exchangeGateway = $exchangeGateway;
    }

    /**
     * @return Exchange[]
     */
    public function getAll(): array
    {
        return $this->exchangeGateway->getAll();
    }
}
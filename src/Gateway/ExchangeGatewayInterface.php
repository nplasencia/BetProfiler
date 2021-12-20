<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Gateway;

use Auret\BetProfiler\Entity\Exchange;

interface ExchangeGatewayInterface
{
    public function add(Exchange $exchange): void;

    /**
     * @return Exchange[]
     */
    public function getAll(): array;
}
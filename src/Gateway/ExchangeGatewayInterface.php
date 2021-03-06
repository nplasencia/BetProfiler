<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Gateway;

use Auret\BetProfiler\Entity\Exchange;

interface ExchangeGatewayInterface
{
    public function add(Exchange $exchange): void;

    public function delete(int $id): void;

    public function update(int $id, Exchange $exchange): void;

    /**
     * @return Exchange[]
     */
    public function getAll(): array;

    public function get(int $id): Exchange;
}
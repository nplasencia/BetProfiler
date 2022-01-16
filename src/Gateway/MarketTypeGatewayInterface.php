<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Gateway;

use Auret\BetProfiler\Entity\MarketType;

interface MarketTypeGatewayInterface
{
    public function add(MarketType $marketType): void;

    public function delete(int $id): void;

    public function update(int $id, MarketType $marketType): void;

    /**
     * @return MarketType[]
     */
    public function getAll(): array;

    public function get(int $id): MarketType;
}
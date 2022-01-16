<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Boundary;

use Auret\BetProfiler\Entity\MarketType;
use Auret\BetProfiler\Model\MarketTypeRequest;

interface MarketTypeBoundaryInterface
{
    public function add(MarketTypeRequest $request): void;

    public function deleteById(int $id): void;

    public function updateById(int $id, MarketTypeRequest $request): void;

    /**
     * @return MarketType[]
     */
    public function getAll(): array;

    public function getById(int $id): MarketType;
}
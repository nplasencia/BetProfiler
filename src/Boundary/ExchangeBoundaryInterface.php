<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Boundary;

use Auret\BetProfiler\Entity\Exchange;
use Auret\BetProfiler\Model\ExchangeRequest;

interface ExchangeBoundaryInterface
{
    public function add(ExchangeRequest $request): void;

    public function deleteById(int $id): void;

    public function updateById(int $id, ExchangeRequest $request): void;

    /**
     * @return Exchange[]
     */
    public function getAll(): array;

    public function getById(int $id): Exchange;
}
<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Boundary;

interface ExchangeBoundaryInterface
{
    public function add(string $jsonRequest): void;

    public function getAll(): array;
}
<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Boundary;

use JsonException;

interface MatchedBetBoundaryInterface
{
    /**
     * @param string $jsonRequest
     * @return void
     * @throws JsonException
     */
    public function add(string $jsonRequest): void;

    public function deleteById(int $id): void;
}
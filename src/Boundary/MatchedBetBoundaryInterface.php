<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Boundary;

use Auret\BetProfiler\Model\MatchedBetRequest;

interface MatchedBetBoundaryInterface
{
    public function add(MatchedBetRequest $request): void;

    public function deleteById(int $id): void;
}
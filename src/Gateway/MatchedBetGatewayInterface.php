<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Gateway;

use Auret\BetProfiler\Entity\MatchedBet;

interface MatchedBetGatewayInterface
{
    public function add(MatchedBet $matchedBet): void;

    public function delete(int $id): void;
}
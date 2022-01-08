<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Gateway;

use Auret\BetProfiler\Entity\LayBet;

interface LayBetGatewayInterface
{
    public function add(LayBet $layBet): LayBet;

    public function delete(int $id): void;
}
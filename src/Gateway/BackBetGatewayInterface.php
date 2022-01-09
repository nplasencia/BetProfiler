<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Gateway;

use Auret\BetProfiler\Entity\BackBet;

interface BackBetGatewayInterface
{
    public function add(BackBet $backBet): BackBet;

    public function delete(int $id): void;
}
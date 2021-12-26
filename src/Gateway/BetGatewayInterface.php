<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Gateway;

use Auret\BetProfiler\Entity\AbstractBet;

interface BetGatewayInterface
{
    public function add(AbstractBet $bet): void;

    public function delete(int $id): void;

    public function update(int $id, AbstractBet $bet): void;

    public function get(int $id): AbstractBet;
}
<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Gateway;

use Auret\BetProfiler\Entity\Bookmaker;

interface BookmakerGatewayInterface
{
    public function add(Bookmaker $exchange): void;

    public function delete(int $id): void;

    public function update(int $id, Bookmaker $exchange): void;

    /**
     * @return Bookmaker[]
     */
    public function getAll(): array;

    public function get(int $id): Bookmaker;
}
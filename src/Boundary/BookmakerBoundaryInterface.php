<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Boundary;

use Auret\BetProfiler\Entity\Bookmaker;
use Auret\BetProfiler\Model\BookmakerRequest;

interface BookmakerBoundaryInterface
{
    public function add(BookmakerRequest $request): void;

    public function deleteById(int $id): void;

    public function updateById(int $id, BookmakerRequest $request): void;

    /**
     * @return Bookmaker[]
     */
    public function getAll(): array;

    public function getById(int $id): Bookmaker;
}
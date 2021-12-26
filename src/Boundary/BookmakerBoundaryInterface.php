<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Boundary;

use Auret\BetProfiler\Entity\Bookmaker;
use JsonException;

interface BookmakerBoundaryInterface
{
    /**
     * @param string $jsonRequest
     * @return void
     * @throws JsonException
     */
    public function add(string $jsonRequest): void;

    /**
     * @param int
     * @return void
     */
    public function deleteById(int $id): void;

    /**
     * @param int $id
     * @param string $jsonRequest
     * @return void
     * @throws JsonException
     */
    public function updateById(int $id, string $jsonRequest): void;

    /**
     * @return Bookmaker[]
     */
    public function getAll(): array;

    public function getById(int $id): Bookmaker;
}
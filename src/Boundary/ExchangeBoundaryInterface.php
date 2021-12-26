<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Boundary;

use Auret\BetProfiler\Entity\Exchange;
use JsonException;

interface ExchangeBoundaryInterface
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
     * @return Exchange[]
     */
    public function getAll(): array;

    public function getById(int $id): Exchange;
}
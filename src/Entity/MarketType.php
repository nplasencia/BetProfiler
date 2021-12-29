<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

final class MarketType
{
    public function __construct(
        private ?int $id,
        private ?string $name,
        private ?string $code
    ) {}
}
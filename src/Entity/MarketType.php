<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

final class MarketType
{
    private string $name;
    private string $code;

    public function __construct(string $name, string $code)
    {
        $this->name = $name;
        $this->code = $code;
    }
}
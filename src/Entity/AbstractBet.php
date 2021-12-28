<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use Auret\BetProfiler\Common\BetResultEnum;

abstract class AbstractBet
{
    public function __construct(
        private float $stake,
        private float $odds,
        private float $liability,
        private float $return,
        private float $profit,
        private string $betType,
        private BetResultEnum $result
    ) {}
}
<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use Auret\BetProfiler\Common\BetResultEnum;

abstract class AbstractBet
{
    protected function __construct(
        protected ?int $id,
        protected float $stake,
        protected float $odds,
        protected float $liability,
        protected float $return,
        protected float $profit,
        protected BetResultEnum $result
    ) {}

    public function getId(): int
    {
        return $this->id;
    }
}
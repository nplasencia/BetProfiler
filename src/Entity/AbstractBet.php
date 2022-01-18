<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use Auret\BetProfiler\Common\BetResultEnum;

abstract class AbstractBet
{
    protected ?int $id;
    protected float $stake;
    protected float $odds;
    protected float $liability;
    protected float $return;
    protected float $profit;
    protected BetResultEnum $result;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStake(): float
    {
        return $this->stake;
    }

    public function getOdds(): float
    {
        return $this->odds;
    }

    public function getLiability(): float
    {
        return $this->liability;
    }

    public function getReturn(): float
    {
        return $this->return;
    }

    public function getProfit(): float
    {
        return $this->profit;
    }

    public function getResult(): BetResultEnum
    {
        return $this->result;
    }
}
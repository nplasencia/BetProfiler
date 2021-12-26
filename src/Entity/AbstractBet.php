<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use Auret\BetProfiler\Common\BetResultEnum;

abstract class AbstractBet
{
    private float $stake;
    private float $odds;
    private float $liability;
    private float $return;
    private float $profit;
    private string $betType;
    private BetResultEnum $result;

    public function __construct(
       float $stake,
       float $odds,
       float $liability,
       float $return,
       float $profit,
       string $betType,
       BetResultEnum $result
    ) {
        $this->stake = $stake;
        $this->odds = $odds;
        $this->liability = $liability;
        $this->return = $return;
        $this->profit = $profit;
        $this->betType = $betType;
        $this->result = $result;
    }
}
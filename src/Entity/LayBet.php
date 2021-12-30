<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use Auret\BetProfiler\Common\BetResultEnum;

final class LayBet extends AbstractBet
{
    private Exchange $exchange;

    public function __construct(
        Exchange $exchange,
        float $stake,
        float $odds,
        float $liability,
        float $return,
        float $profit,
        BetResultEnum $result
    ) {
        $this->exchange = $exchange;
        parent::__construct($stake, $odds, $liability, $return, $profit, $result);
    }
}
<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use Auret\BetProfiler\Common\BetResultEnum;

final class BackBet extends AbstractBet
{
    private Bookmaker $bookmaker;

    public function __construct(
        Bookmaker $bookmaker,
        float $stake,
        float $odds,
        float $return,
        float $profit,
        string $betType,
        BetResultEnum $result
    ) {
        $this->bookmaker = $bookmaker;
        parent::__construct($stake, $odds, 0, $return, $profit, $betType, $result);
    }
}
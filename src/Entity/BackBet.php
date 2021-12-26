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
       float $liability,
       float $return,
       float $profit,
       string $betType,
       BetResultEnum $result
    ) {
        $this->bookmaker = $bookmaker;
        parent::__construct($stake, $odds, $liability, $return, $profit, $betType, $result);
    }
}
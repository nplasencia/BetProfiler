<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use Auret\BetProfiler\Common\BetResultEnum;

final class BackBet extends AbstractBet
{
    public function __construct(
        private Bookmaker $bookmaker,
        protected ?int $id,
        protected float $stake,
        protected float $odds,
        protected float $return,
        protected float $profit,
        protected BetResultEnum $result
    ) {
        parent::__construct($id, $stake, $odds, 0, $return, $profit, $result);
    }
}
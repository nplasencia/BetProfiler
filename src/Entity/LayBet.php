<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use Auret\BetProfiler\Common\BetResultEnum;

final class LayBet extends AbstractBet
{
    public function __construct(
        private Exchange $exchange,
        protected ?int $id,
        protected float $stake,
        protected float $odds,
        protected float $liability,
        protected float $return,
        protected float $profit,
        protected BetResultEnum $result
    ) {
        parent::__construct($id, $stake, $odds, $liability, $return, $profit, $result);
    }
}
<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Model;

use Auret\BetProfiler\Common\BetResultEnum;

final class LayBetRequest extends AbstractBetRequest
{
    public function __construct(
        private int $exchangeId,
        protected float $stake,
        protected float $odds,
        protected float $liability,
        protected float $return,
        protected float $profit,
        protected BetResultEnum $result,
    ) {
        parent::__construct($stake, $odds, $liability, $return, $profit, $result);
    }

    public function getExchangeId(): int
    {
        return $this->exchangeId;
    }
}
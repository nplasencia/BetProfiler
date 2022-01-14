<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Model;

use Auret\BetProfiler\Common\BetResultEnum;

final class BackBetRequest extends AbstractBetRequest
{
    public function __construct(
        private int $bookmakerId,
        protected float $stake,
        protected float $odds,
        protected float $return,
        protected float $profit,
        protected BetResultEnum $result,
    ) {}

    public function getBookmakerId(): int
    {
        return $this->bookmakerId;
    }
}
<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use Auret\BetProfiler\Common\BetResultEnum;

final class BackBet extends AbstractBet
{
    public function __construct(
        protected ?int $id,
        private Bookmaker $bookmaker,
        protected float $stake,
        protected float $odds,
        protected float $return,
        protected float $profit,
        protected BetResultEnum $result
    ) {}

    public function getBookmaker(): Bookmaker
    {
        return $this->bookmaker;
    }
}
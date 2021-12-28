<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use Auret\BetProfiler\Common\MatchedBetModeEnum;
use Auret\BetProfiler\Common\MatchedBetTypeEnum;

final class MatchedBet
{
    public function __construct(
        private Bookmaker $bookmaker,
        private Exchange $exchange,
        private Event $event,
        private MarketType $marketType,
        private MatchedBetTypeEnum $type,
        private MatchedBetModeEnum $mode,
        private string $notes
    ) {}
}
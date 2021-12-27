<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use Auret\BetProfiler\Common\MatchedBetModeEnum;
use Auret\BetProfiler\Common\MatchedBetTypeEnum;

final class MatchedBet
{
    private Bookmaker $bookmaker;
    private Exchange $exchange;
    private Event $event;
    private MarketType $marketType;
    private MatchedBetTypeEnum $type;
    private MatchedBetModeEnum $mode;
    private string $notes;

    public function __construct(
       Bookmaker $bookmaker,
       Exchange $exchange,
       Event $event,
       MarketType $marketType,
       MatchedBetTypeEnum $type,
       MatchedBetModeEnum $mode,
       string $notes
    ) {
        $this->bookmaker = $bookmaker;
        $this->exchange = $exchange;
        $this->event = $event;
        $this->marketType = $marketType;
        $this->type = $type;
        $this->mode = $mode;
        $this->notes = $notes;
    }
}
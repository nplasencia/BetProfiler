<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

use Auret\BetProfiler\Common\MatchedBetModeEnum;
use Auret\BetProfiler\Common\MatchedBetTypeEnum;

final class MatchedBet
{
    public function __construct(
        private ?int $id,
        private BackBet $backBet,
        private LayBet $layBet,
        private Event $event,
        private string $bet,
        private MarketType $marketType,
        private MatchedBetTypeEnum $type,
        private MatchedBetModeEnum $mode,
        private string $notes
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBackBet(): BackBet
    {
        return $this->backBet;
    }

    public function getLayBet(): LayBet
    {
        return $this->layBet;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function getBet(): string
    {
        return $this->bet;
    }

    public function getMarketType(): MarketType
    {
        return $this->marketType;
    }

    public function getType(): MatchedBetTypeEnum
    {
        return $this->type;
    }

    public function getMode(): MatchedBetModeEnum
    {
        return $this->mode;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }
}
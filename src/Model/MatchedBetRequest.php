<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Model;

use Auret\BetProfiler\Common\MatchedBetModeEnum;
use Auret\BetProfiler\Common\MatchedBetTypeEnum;

final class MatchedBetRequest implements RequestInterface
{
    public function __construct(
        private BackBetRequest $backBetRequest,
        private LayBetRequest $layBetRequest,
        private EventRequest $eventRequest,
        private string $bet,
        private int $marketTypeId,
        private string $betType,
        private string $betMode,
        private string $notes,
    ) {}

    public function getBackBetRequest(): BackBetRequest
    {
        return $this->backBetRequest;
    }

    public function getLayBetRequest(): LayBetRequest
    {
        return $this->layBetRequest;
    }

    public function getEventRequest(): EventRequest
    {
        return $this->eventRequest;
    }

    public function getBet(): string
    {
        return $this->bet;
    }

    public function getMarketTypeId(): int
    {
        return $this->marketTypeId;
    }

    public function getBetType(): MatchedBetTypeEnum
    {
        return MatchedBetTypeEnum::from($this->betType);
    }

    public function getBetMode(): MatchedBetModeEnum
    {
        return MatchedBetModeEnum::from($this->betMode);
    }

    public function getNotes(): string
    {
        return $this->notes;
    }
}
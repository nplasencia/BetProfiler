<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Model;

final class MatchedBetRequest implements RequestInterface
{public function __construct(
       private int $bookmakerId,
       private int $exchangeId,
       private int $eventId,
       private int $marketTypeId,
       private string $betType,
       private string $betMode,
       private string $notes,
    ) {}

    public function getBookmakerId(): int
    {
        return $this->bookmakerId;
    }

    public function getExchangeId(): int
    {
        return $this->exchangeId;
    }

    public function getEventId(): int
    {
        return $this->eventId;
    }

    public function getMarketTypeId(): int
    {
        return $this->marketTypeId;
    }

    public function getBetType(): string
    {
        return $this->betType;
    }

    public function getBetMode(): string
    {
        return $this->betMode;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }
}
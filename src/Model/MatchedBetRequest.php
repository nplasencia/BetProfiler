<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Model;

final class MatchedBetRequest implements RequestInterface
{
    private int $bookmakerId;
    private int $exchangeId;
    private int $eventId;
    private int $marketTypeId;
    private string $betType;
    private string $notes;

    public function __construct(
       int $bookmakerId,
       int $exchangeId,
       int $eventId,
       int $marketTypeId,
       string $betType,
       string $notes
    ) {
        $this->bookmakerId = $bookmakerId;
        $this->exchangeId = $exchangeId;
        $this->eventId = $eventId;
        $this->marketTypeId = $marketTypeId;
        $this->betType = $betType;
        $this->notes = $notes;
    }

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

    public function getNotes(): string
    {
        return $this->notes;
    }
}
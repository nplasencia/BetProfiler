<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Model\Factory;

use Auret\BetProfiler\Model\MatchedBetRequest;
use Auret\BetProfiler\Model\RequestInterface;
use stdClass;

final class MatchedBetRequestFactory extends AbstractRequestFactory
{
    /**
     * @return string[]
     */
    protected function getNeededProperties(): array
    {
        return ['bookmakerId', 'exchangeId', 'eventId', 'marketTypeId', 'betType', 'betMode', 'notes'];
    }

    protected function returnRequest(stdClass $decodedRequest): RequestInterface
    {
        return new MatchedBetRequest(
           $decodedRequest->bookmakerId,
           $decodedRequest->exchangeId,
           $decodedRequest->eventId,
           $decodedRequest->marketTypeId,
           $decodedRequest->betType,
           $decodedRequest->betMode,
           $decodedRequest->notes
        );
    }
}
<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Interactor;

use Auret\BetProfiler\Boundary\MatchedBetBoundaryInterface;
use Auret\BetProfiler\Common\MatchedBetModeEnum;
use Auret\BetProfiler\Common\MatchedBetTypeEnum;
use Auret\BetProfiler\Entity\Bookmaker;
use Auret\BetProfiler\Entity\Event;
use Auret\BetProfiler\Entity\Exchange;
use Auret\BetProfiler\Entity\MarketType;
use Auret\BetProfiler\Entity\MatchedBet;
use Auret\BetProfiler\Gateway\MatchedBetGatewayInterface;
use Auret\BetProfiler\Model\Factory\RequestFactoryInterface;
use Auret\BetProfiler\Model\MatchedBetRequest;

final class MatchedBetInteractor implements MatchedBetBoundaryInterface
{
    public function __construct(
        private MatchedBetGatewayInterface $matchedBetGateway,
        private RequestFactoryInterface $requestFactory
    ) {}

    /**
     * @inheritDoc
     */
    public function add(string $jsonRequest): void
    {
        /** @var MatchedBetRequest $matchedBetRequest */
        $matchedBetRequest = $this->requestFactory->create($jsonRequest);
        $matchedBet = $this->getMatchedBetFromRequest($matchedBetRequest);
        $this->matchedBetGateway->add($matchedBet);
    }

    private function getMatchedBetFromRequest(MatchedBetRequest $request): MatchedBet
    {
        return new MatchedBet(
            new Bookmaker($request->getBookmakerId(), null, null),
            new Exchange($request->getExchangeId(), null, null),
            new Event($request->getEventId(), null, null, null),
            new MarketType($request->getMarketTypeId(), null, null),
            MatchedBetTypeEnum::from($request->getBetType()),
            MatchedBetModeEnum::from($request->getBetMode()),
            $request->getNotes()
        );
    }
}
<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Interactor;

use Auret\BetProfiler\Boundary\MatchedBetBoundaryInterface;
use Auret\BetProfiler\Common\BetResultEnum;
use Auret\BetProfiler\Controller\BackBetController;
use Auret\BetProfiler\Controller\EventController;
use Auret\BetProfiler\Controller\LayBetController;
use Auret\BetProfiler\Entity\BackBet;
use Auret\BetProfiler\Entity\Event;
use Auret\BetProfiler\Entity\LayBet;
use Auret\BetProfiler\Entity\MarketType;
use Auret\BetProfiler\Entity\MatchedBet;
use Auret\BetProfiler\Exception\MatchedBetRequestValidationException;
use Auret\BetProfiler\Gateway\MatchedBetGatewayInterface;
use Auret\BetProfiler\Model\MatchedBetRequest;
use http\Exception\RuntimeException;
use ValueError;

final class MatchedBetInteractor implements MatchedBetBoundaryInterface
{
    public function __construct(
        private MatchedBetGatewayInterface $matchedBetGateway,
        private BackBetController $backBetController,
        private LayBetController $layBetController,
        private EventController $eventController,
    ) {}

    public function add(MatchedBetRequest $request): void
    {
        $this->validateRequest($request);

        $backBet = $this->backBetController->add($request->getBackBetRequest());
        $layBet = $this->layBetController->add($request->getLayBetRequest());
        $event = $this->eventController->add($request->getEventRequest());

        $matchedBet = $this->getMatchedBetFromRequest($request, $backBet, $layBet, $event);
        $this->matchedBetGateway->add($matchedBet);
    }

    public function deleteById(int $id): void
    {
        $this->matchedBetGateway->delete($id);
    }

    private function validateRequest(MatchedBetRequest $request): void
    {
        $this->validateBetResults($request->getLayBetRequest()->getResult(), $request->getBackBetRequest()->getResult());
        $this->validateBetType($request);
        $this->validateBetMode($request);
    }

    private function validateBetResults(BetResultEnum $backBetResult, BetResultEnum $layBetResult): void
    {
        if ($backBetResult === $layBetResult) {
            throw new MatchedBetRequestValidationException('BackBet and LayBet results are the same');
        }
    }

    private function validateBetType(MatchedBetRequest $request): void
    {
        try {
            $request->getBetType();
        } catch (ValueError $error) {
            throw new MatchedBetRequestValidationException('Undefined BetType');
        }
    }

    private function validateBetMode(MatchedBetRequest $request): void
    {
        try {
            $request->getBetMode();
        } catch (ValueError $error) {
            throw new MatchedBetRequestValidationException('Undefined BetMode');
        }
    }

    private function getMatchedBetFromRequest(
        MatchedBetRequest $request,
        BackBet $backBet,
        LayBet $layBet,
        Event $event
    ): MatchedBet {
        return new MatchedBet(
            null,
            $backBet,
            $layBet,
            $event,
            $request->getBet(),
            new MarketType($request->getMarketTypeId(), null, null),
            $request->getBetType(),
            $request->getBetMode(),
            $request->getNotes()
        );
    }
}
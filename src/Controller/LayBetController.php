<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Controller;

use Auret\BetProfiler\Entity\Exchange;
use Auret\BetProfiler\Entity\LayBet;
use Auret\BetProfiler\Gateway\LayBetGatewayInterface;
use Auret\BetProfiler\Model\LayBetRequest;

final class LayBetController
{
    public function __construct(
        private LayBetGatewayInterface $gateway
    ) {}

    public function add(LayBetRequest $request): LayBet
    {
        $event = $this->getLayBetFromRequest($request);
        return $this->gateway->add($event);
    }

    private function getLayBetFromRequest(LayBetRequest $request): LayBet
    {
        return new LayBet(
            new Exchange($request->getExchangeId(), null, null),
            null,
            $request->getStake(),
            $request->getOdds(),
            $request->getLiability(),
            $request->getReturn(),
            $request->getProfit(),
            $request->getResult()
        );
    }
}
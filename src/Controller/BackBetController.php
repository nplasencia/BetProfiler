<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Controller;

use Auret\BetProfiler\Entity\BackBet;
use Auret\BetProfiler\Entity\Bookmaker;
use Auret\BetProfiler\Gateway\BackBetGatewayInterface;
use Auret\BetProfiler\Model\BackBetRequest;

class BackBetController
{
    public function __construct(
        private BackBetGatewayInterface $gateway
    ) {}

    public function add(BackBetRequest $request): BackBet
    {
        $backBet = $this->getBackBetFromRequest($request);
        return $this->gateway->add($backBet);
    }

    private function getBackBetFromRequest(BackBetRequest $request): BackBet
    {
        return new BackBet(
            null,
            new Bookmaker($request->getBookmakerId(), null, null),
            $request->getStake(),
            $request->getOdds(),
            $request->getReturn(),
            $request->getProfit(),
            $request->getResult()
        );
    }
}
<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Utils;

use Auret\BetProfiler\Common\BetResultEnum;
use Auret\BetProfiler\Entity\BackBet;
use Auret\BetProfiler\Entity\Bookmaker;
use Auret\BetProfiler\Model\BackBetRequest;

final class BackBetUtils
{
    public function getBackBet(
        int $bookmakerId,
        ?int $backBetId,
        float $stake,
        float $odds,
        float $return,
        float $profit,
        BetResultEnum $betResult
    ): BackBet {
        $bookmaker = new Bookmaker($bookmakerId, null, null);
        return new BackBet($bookmaker, $backBetId, $stake, $odds, $return, $profit, $betResult);
    }

    public function getBackBetRequest(
        int $bookmakerId,
        float $stake,
        float $odds,
        float $return,
        float $profit,
        BetResultEnum $betResult
    ): BackBetRequest {
        return new BackBetRequest($bookmakerId, $stake, $odds, $return, $profit, $betResult);
    }
}
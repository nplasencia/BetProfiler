<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Utils;

use Auret\BetProfiler\Common\BetResultEnum;
use Auret\BetProfiler\Entity\Exchange;
use Auret\BetProfiler\Entity\LayBet;
use Auret\BetProfiler\Model\LayBetRequest;

final class LayBetUtils
{
    public function getLayBet(
        int $exchangeId,
        ?int $backBetId,
        float $stake,
        float $odds,
        float $liability,
        float $return,
        float $profit,
        BetResultEnum $betResult
    ): LayBet {
        $exchange = new Exchange($exchangeId, null, null);
        return new LayBet($exchange, $backBetId, $stake, $odds, $liability, $return, $profit, $betResult);
    }

    public function getLayBetRequest(
        int $exchangeId,
        float $stake,
        float $odds,
        float $liability,
        float $return,
        float $profit,
        BetResultEnum $betResult
    ): LayBetRequest {
        return new LayBetRequest($exchangeId, $stake, $odds, $liability, $return, $profit, $betResult);
    }
}
<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Controller;

use Auret\BetProfiler\Common\BetResultEnum;
use Auret\BetProfiler\Controller\LayBetController;
use Auret\BetProfiler\Entity\Exchange;
use Auret\BetProfiler\Entity\LayBet;
use Auret\BetProfiler\Gateway\LayBetGatewayInterface;
use Auret\BetProfiler\Model\LayBetRequest;
use PHPUnit\Framework\TestCase;

final class LayBetControllerTest extends TestCase
{
    private LayBetController $layBetController;
    private LayBetGatewayInterface $layBetGateway;

    protected function setUp(): void
    {
        $this->layBetGateway = $this->createMock(LayBetGatewayInterface::class);
        $this->layBetController = new LayBetController($this->layBetGateway);
    }

    /**
     * @covers LayBetController::add
     */
    public function testAdd_success(): void
    {
        $exchangeId = 99;
        $stake = 1.23;
        $odd = 4.56;
        $liability = 123.45;
        $return = 35.89;
        $profit = 25.3;
        $betResult = BetResultEnum::LOSE;

        $expectedLayBetToStore = $this->getLayBet($exchangeId, null, $stake, $odd, $liability, $return, $profit, $betResult);
        $expectedLayBetStored = $this->getLayBet($exchangeId, 1, $stake, $odd, $liability, $return, $profit, $betResult);
        $this->layBetGateway->expects($this->once())->method('add')->with($expectedLayBetToStore)->willReturn($expectedLayBetStored);

        $request = new LayBetRequest($exchangeId, $stake, $odd, $liability, $return, $profit, $betResult);
        $this->layBetController->add($request);
    }

    private function getLayBet(
        int $exchangeId,
        ?int $backBetId,
        float $stake,
        float $odd,
        float $liability,
        float $return,
        float $profit,
        BetResultEnum $betResult
    ): LayBet {
        return new LayBet(new Exchange($exchangeId, null, null), $backBetId, $stake, $odd, $liability, $return, $profit, $betResult);
    }
}
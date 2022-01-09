<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Controller;

use Auret\BetProfiler\Common\BetResultEnum;
use Auret\BetProfiler\Controller\LayBetController;
use Auret\BetProfiler\Gateway\LayBetGatewayInterface;
use Auret\BetProfiler\Tests\Utils\LayBetUtils;
use PHPUnit\Framework\TestCase;

final class LayBetControllerTest extends TestCase
{
    private LayBetController $layBetController;
    private LayBetGatewayInterface $layBetGateway;

    private LayBetUtils $layBetUtils;

    protected function setUp(): void
    {
        $this->layBetUtils = new LayBetUtils();

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
        $odds = 4.56;
        $liability = 123.45;
        $return = 35.89;
        $profit = 25.3;
        $betResult = BetResultEnum::LOSE;

        $expectedLayBetToStore = $this->layBetUtils->getLayBet(null, $exchangeId, $stake, $odds, $liability, $return, $profit, $betResult);
        $expectedLayBetStored = $this->layBetUtils->getLayBet(1, $exchangeId, $stake, $odds, $liability, $return, $profit, $betResult);
        $this->layBetGateway->expects($this->once())->method('add')->with($expectedLayBetToStore)->willReturn($expectedLayBetStored);

        $request = $this->layBetUtils->getLayBetRequest($exchangeId, $stake, $odds, $liability, $return, $profit, $betResult);
        $this->layBetController->add($request);
    }
}
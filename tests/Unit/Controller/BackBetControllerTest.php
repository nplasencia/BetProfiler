<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Controller;

use Auret\BetProfiler\Common\BetResultEnum;
use Auret\BetProfiler\Controller\BackBetController;
use Auret\BetProfiler\Gateway\BackBetGatewayInterface;
use Auret\BetProfiler\Tests\Utils\BackBetUtils;
use PHPUnit\Framework\TestCase;

final class BackBetControllerTest extends TestCase
{
    private BackBetController $backBetController;
    private BackBetGatewayInterface $backBetGateway;

    private BackBetUtils $backBetUtils;

    protected function setUp(): void
    {
        $this->backBetUtils = new BackBetUtils();

        $this->backBetGateway = $this->createMock(BackBetGatewayInterface::class);
        $this->backBetController = new BackBetController($this->backBetGateway);
    }

    /**
     * @covers BackBetController::add
     */
    public function testAdd_success(): void
    {
        $bookmakerId = 99;
        $stake = 1.23;
        $odds = 4.56;
        $return = 35.89;
        $profit = 25.3;
        $betResult = BetResultEnum::WIN;

        $expectedBackBetToStore = $this->backBetUtils->getBackBet(null, $bookmakerId, $stake, $odds, $return, $profit, $betResult);
        $expectedBackBetStored = $this->backBetUtils->getBackBet(1, $bookmakerId, $stake, $odds, $return, $profit, $betResult);
        $this->backBetGateway->expects($this->once())->method('add')->with($expectedBackBetToStore)->willReturn($expectedBackBetStored);

        $request = $this->backBetUtils->getBackBetRequest($bookmakerId, $stake, $odds, $return, $profit, $betResult);
        $this->backBetController->add($request);
    }
}
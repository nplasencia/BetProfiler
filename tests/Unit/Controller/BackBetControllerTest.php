<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Controller;

use Auret\BetProfiler\Common\BetResultEnum;
use Auret\BetProfiler\Controller\BackBetController;
use Auret\BetProfiler\Entity\BackBet;
use Auret\BetProfiler\Entity\Bookmaker;
use Auret\BetProfiler\Gateway\BackBetGatewayInterface;
use Auret\BetProfiler\Model\BackBetRequest;
use PHPUnit\Framework\TestCase;

final class BackBetControllerTest extends TestCase
{
    private BackBetController $backBetController;
    private BackBetGatewayInterface $backBetGateway;

    protected function setUp(): void
    {
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
        $odd = 4.56;
        $return = 35.89;
        $profit = 25.3;
        $betResult = BetResultEnum::WIN;

        $expectedBackBetToStore = $this->getBackBet($bookmakerId, null, $stake, $odd, $return, $profit, $betResult);
        $expectedBackBetStored = $this->getBackBet($bookmakerId, 1, $stake, $odd, $return, $profit, $betResult);
        $this->backBetGateway->expects($this->once())->method('add')->with($expectedBackBetToStore)->willReturn($expectedBackBetStored);

        $request = new BackBetRequest($bookmakerId, $stake, $odd, $return, $profit, $betResult);
        $this->backBetController->add($request);
    }

    private function getBackBet(
        int $bookmakerId,
        ?int $backBetId,
        float $stake,
        float $odd,
        float $return,
        float $profit,
        BetResultEnum $betResult
    ): BackBet {
        return new BackBet(new Bookmaker($bookmakerId, null, null), $backBetId, $stake, $odd, $return, $profit, $betResult);
    }
}
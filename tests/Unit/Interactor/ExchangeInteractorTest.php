<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Interactor;

use Auret\BetProfiler\Entity\Exchange;
use Auret\BetProfiler\Gateway\ExchangeGatewayInterface;
use Auret\BetProfiler\Interactor\ExchangeInteractor;
use Auret\BetProfiler\Model\ExchangeRequest;
use Auret\BetProfiler\Model\Factory\RequestFactoryInterface;
use PHPUnit\Framework\TestCase;

final class ExchangeInteractorTest extends TestCase
{
    private ExchangeInteractor $exchangeInteractor;

    private ExchangeGatewayInterface $exchangeGateway;
    private RequestFactoryInterface $requestFactory;

    protected function setUp(): void
    {
        $this->exchangeGateway = $this->createMock(ExchangeGatewayInterface::class);
        $this->requestFactory = $this->createMock(RequestFactoryInterface::class);

        $this->exchangeInteractor = new ExchangeInteractor($this->exchangeGateway, $this->requestFactory);
    }

    /**
     * @covers ExchangeInteractor::getAll
     */
    public function testGetOnlyOneExchange(): void
    {
        $exchange = new Exchange('Exchange Name', 'https://exchange.test.com');

        $this->exchangeGateway->expects($this->once())->method('getAll')
           ->willReturn([$exchange]);

        $expected = [$exchange];
        $this->assertEquals($expected, $this->exchangeInteractor->getAll());
    }

    /**
     * @covers ExchangeInteractor::getAll
     */
    public function testGetManyExchanges(): void
    {
        $exchange1 = new Exchange('Exchange Name 1', 'https://exchange1.test.com');
        $exchange2 = new Exchange('Exchange Name 2', 'https://exchange2.test.com');
        $exchange3 = new Exchange('Exchange Name 3', 'https://exchange3.test.com');

        $this->exchangeGateway->expects($this->once())->method('getAll')
           ->willReturn([$exchange1, $exchange2, $exchange3]);

        $expected = [$exchange1, $exchange2, $exchange3];
        $this->assertEquals($expected, $this->exchangeInteractor->getAll());
    }

    /**
     * @covers ExchangeInteractor::add
     */
    public function testAddNewExchange(): void
    {
        $exchangeName = 'Exchange Name';
        $exchangeUrl = 'https://exchange.test.com';
        $jsonRequest = sprintf('{"name":"%s", "url":"%s"}', $exchangeName, $exchangeUrl);

        $exchangeRequest = new ExchangeRequest($exchangeName, $exchangeUrl);
        $this->requestFactory->expects($this->once())->method('create')->with($jsonRequest)->willReturn($exchangeRequest);
        $this->exchangeGateway->expects($this->once())->method('add')->with(new Exchange($exchangeName, $exchangeUrl));

        $this->exchangeInteractor->add($jsonRequest);
    }

    /**
     * @covers ExchangeInteractor::deleteById
     */
    public function testDeleteById(): void
    {
        $exchangeId = 1;

        $this->exchangeGateway->expects($this->once())->method('delete')->with($exchangeId);
        $this->exchangeInteractor->deleteById($exchangeId);
    }

    /**
     * @covers ExchangeInteractor::updateById
     */
    public function testUpdateById(): void
    {
        $exchangeId = 99;
        $newExchangeName = 'New Exchange Name';
        $newExchangeUrl = 'https://new-exchange.test.com';
        $jsonRequest = sprintf('{"name":"%s", "url":"%s"}', $newExchangeName, $newExchangeUrl);

        $exchangeRequest = new ExchangeRequest($newExchangeName, $newExchangeUrl);
        $this->requestFactory->expects($this->once())->method('create')->with($jsonRequest)->willReturn($exchangeRequest);
        $this->exchangeGateway->expects($this->once())->method('update')
           ->with($exchangeId, new Exchange($newExchangeName, $newExchangeUrl));

        $this->exchangeInteractor->updateById($exchangeId, $jsonRequest);
    }

    /**
     * @covers ExchangeInteractor::getById
     */
    public function testGetById(): void
    {
        $exchangeId = 99;
        $exchangeName = 'New Exchange Name';
        $exchangeUrl = 'https://new-exchange.test.com';

        $this->exchangeGateway->expects($this->once())->method('get')
           ->willReturn(new Exchange($exchangeName, $exchangeUrl));

        $expected = new Exchange($exchangeName, $exchangeUrl);
        $this->assertEquals($expected, $this->exchangeInteractor->getById($exchangeId));
    }
}

<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Tests\Interactor;

use Auret\BetProfiler\Entity\Bookmaker;
use Auret\BetProfiler\Gateway\BookmakerGatewayInterface;
use Auret\BetProfiler\Interactor\BookmakerInteractor;
use Auret\BetProfiler\Model\BookmakerRequest;
use Auret\BetProfiler\Model\Factory\RequestFactoryInterface;
use PHPUnit\Framework\TestCase;

final class BookmakerInteractorTest extends TestCase
{
    private BookmakerInteractor $bookmakerInteractor;

    private BookmakerGatewayInterface $bookmakerGateway;
    private RequestFactoryInterface $requestFactory;

    protected function setUp(): void
    {
        $this->bookmakerGateway = $this->createMock(BookmakerGatewayInterface::class);
        $this->requestFactory = $this->createMock(RequestFactoryInterface::class);

        $this->bookmakerInteractor = new BookmakerInteractor($this->bookmakerGateway, $this->requestFactory);
    }

    /**
     * @covers BookmakerInteractor::getAll
     */
    public function testGetOnlyOneBookmaker(): void
    {
        $Bookmaker = new Bookmaker(1, 'Bookmaker Name', 'https://Bookmaker.test.com');

        $this->bookmakerGateway->expects($this->once())->method('getAll')
           ->willReturn([$Bookmaker]);

        $expected = [$Bookmaker];
        $this->assertEquals($expected, $this->bookmakerInteractor->getAll());
    }

    /**
     * @covers BookmakerInteractor::getAll
     */
    public function testGetManyBookmakers(): void
    {
        $bookmaker1 = new Bookmaker(1, 'Bookmaker Name 1', 'https://Bookmaker1.test.com');
        $bookmaker2 = new Bookmaker(2, 'Bookmaker Name 2', 'https://Bookmaker2.test.com');
        $bookmaker3 = new Bookmaker(3, 'Bookmaker Name 3', 'https://Bookmaker3.test.com');

        $this->bookmakerGateway->expects($this->once())->method('getAll')
           ->willReturn([$bookmaker1, $bookmaker2, $bookmaker3]);

        $expected = [$bookmaker1, $bookmaker2, $bookmaker3];
        $this->assertEquals( $expected, $this->bookmakerInteractor->getAll() );
    }

    /**
     * @covers BookmakerInteractor::add
     */
    public function testAddNewBookmaker(): void
    {
        $bookmakerName = 'Bookmaker Name';
        $bookmakerUrl = 'https://Bookmaker.test.com';
        $jsonRequest = sprintf('{"name":"%s", "url":"%s"}', $bookmakerName, $bookmakerUrl);

        $BookmakerRequest = new BookmakerRequest($bookmakerName, $bookmakerUrl);
        $this->requestFactory->expects($this->once())->method('create')->with($jsonRequest)->willReturn($BookmakerRequest);
        $this->bookmakerGateway->expects($this->once())->method('add')->with(new Bookmaker(null, $bookmakerName, $bookmakerUrl));

        $this->bookmakerInteractor->add($jsonRequest);
    }

    /**
     * @covers BookmakerInteractor::deleteById
     */
    public function testDeleteById(): void
    {
        $bookmakerId = 1;

        $this->bookmakerGateway->expects($this->once())->method('delete')->with($bookmakerId);
        $this->bookmakerInteractor->deleteById($bookmakerId);
    }

    /**
     * @covers BookmakerInteractor::updateById
     */
    public function testUpdateById(): void
    {
        $bookmakerId = 99;
        $newBookmakerName = 'New Bookmaker Name';
        $newBookmakerUrl = 'https://new-Bookmaker.test.com';
        $jsonRequest = sprintf('{"name":"%s", "url":"%s"}', $newBookmakerName, $newBookmakerUrl);

        $bookmakerRequest = new BookmakerRequest($newBookmakerName, $newBookmakerUrl);
        $this->requestFactory->expects($this->once())->method('create')->with($jsonRequest)->willReturn($bookmakerRequest);
        $this->bookmakerGateway->expects($this->once())->method('update')
           ->with($bookmakerId, new Bookmaker(null, $newBookmakerName, $newBookmakerUrl));

        $this->bookmakerInteractor->updateById($bookmakerId, $jsonRequest);
    }

    /**
     * @covers BookmakerInteractor::getById
     */
    public function testGetById(): void
    {
        $bookmakerId = 99;
        $bookmakerName = 'New Bookmaker Name';
        $bookmakerUrl = 'https://new-Bookmaker.test.com';

        $this->bookmakerGateway->expects($this->once())->method('get')
           ->willReturn(new Bookmaker($bookmakerId, $bookmakerName, $bookmakerUrl));

        $expected = new Bookmaker($bookmakerId, $bookmakerName, $bookmakerUrl);
        $this->assertEquals($expected, $this->bookmakerInteractor->getById($bookmakerId));
    }
}

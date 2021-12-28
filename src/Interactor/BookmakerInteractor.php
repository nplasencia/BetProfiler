<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Interactor;



use Auret\BetProfiler\Boundary\BookmakerBoundaryInterface;
use Auret\BetProfiler\Entity\Bookmaker;
use Auret\BetProfiler\Gateway\BookmakerGatewayInterface;
use Auret\BetProfiler\Model\BookmakerRequest;
use Auret\BetProfiler\Model\Factory\RequestFactoryInterface;

final class BookmakerInteractor implements BookmakerBoundaryInterface
{
    private BookmakerGatewayInterface $bookmakerGateway;
    private RequestFactoryInterface $requestFactory;

    public function __construct(BookmakerGatewayInterface $bookmakerGateway, RequestFactoryInterface $requestFactory)
    {
        $this->bookmakerGateway = $bookmakerGateway;
        $this->requestFactory = $requestFactory;
    }

    /**
     * @inheritDoc
     */
    public function add(string $jsonRequest): void
    {
        /** @var BookmakerRequest $bookmakerRequest */
        $bookmakerRequest = $this->requestFactory->create($jsonRequest);
        $bookmaker = new Bookmaker(null, $bookmakerRequest->getName(), $bookmakerRequest->getUrl());
        $this->bookmakerGateway->add($bookmaker);
    }

    public function deleteById(int $id): void
    {
        $this->bookmakerGateway->delete($id);
    }

    /**
     * @inheritDoc
     */
    public function updateById(int $id, string $jsonRequest): void
    {
        /** @var BookmakerRequest $bookmakerRequest */
        $bookmakerRequest = $this->requestFactory->create($jsonRequest);
        $bookmaker = new Bookmaker(null, $bookmakerRequest->getName(), $bookmakerRequest->getUrl());
        $this->bookmakerGateway->update($id, $bookmaker);
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        return $this->bookmakerGateway->getAll();
    }

    public function getById(int $id): Bookmaker
    {
        return $this->bookmakerGateway->get($id);
    }
}
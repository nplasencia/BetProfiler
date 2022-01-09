<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Interactor;

use Auret\BetProfiler\Boundary\BookmakerBoundaryInterface;
use Auret\BetProfiler\Entity\Bookmaker;
use Auret\BetProfiler\Gateway\BookmakerGatewayInterface;
use Auret\BetProfiler\Model\BookmakerRequest;

final class BookmakerInteractor implements BookmakerBoundaryInterface
{
    public function __construct(
        private BookmakerGatewayInterface $bookmakerGateway
    ) {}

    public function add(BookmakerRequest $request): void
    {
        $bookmaker = new Bookmaker(null, $request->getName(), $request->getUrl());
        $this->bookmakerGateway->add($bookmaker);
    }

    public function deleteById(int $id): void
    {
        $this->bookmakerGateway->delete($id);
    }

    public function updateById(int $id, BookmakerRequest $request): void
    {
        $bookmaker = new Bookmaker($id, $request->getName(), $request->getUrl());
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
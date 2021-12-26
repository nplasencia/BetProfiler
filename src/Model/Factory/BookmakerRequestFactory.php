<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Model\Factory;

use Auret\BetProfiler\Model\BookmakerRequest;
use Auret\BetProfiler\Model\RequestInterface;
use stdClass;

final class BookmakerRequestFactory extends AbstractRequestFactory
{
    /**
     * @return string[]
     */
    protected function getNeededProperties(): array
    {
        return ['name', 'url'];
    }

    protected function returnRequest(stdClass $decodedRequest): RequestInterface
    {
        return new BookmakerRequest($decodedRequest->name, $decodedRequest->url);
    }
}
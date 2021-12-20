<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Factory;

use Auret\BetProfiler\Model\ExchangeRequest;
use Auret\BetProfiler\Model\RequestInterface;
use stdClass;

final class ExchangeRequestFactory extends AbstractRequestFactory
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
        return new ExchangeRequest($decodedRequest->name, $decodedRequest->url);
    }
}
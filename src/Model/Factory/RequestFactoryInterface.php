<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Model\Factory;

use Auret\BetProfiler\Model\RequestInterface;
use JsonException;

interface RequestFactoryInterface
{
    /**
     * @param string $jsonRequest
     * @return RequestInterface
     * @throws JsonException
     */
    public function create(string $jsonRequest): RequestInterface;
}
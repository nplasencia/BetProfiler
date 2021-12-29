<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Model;

final class ExchangeRequest implements RequestInterface
{
    public function __construct(
        private string $name,
        private string $url
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
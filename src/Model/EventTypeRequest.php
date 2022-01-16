<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Model;

final class EventTypeRequest implements RequestInterface
{
    public function __construct(
       private string $name,
       private string $code
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
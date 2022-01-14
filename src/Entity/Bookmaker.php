<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Entity;

final class Bookmaker
{
    public function __construct(
        private ?int $id,
        private ?string $name,
        private ?string $url
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}
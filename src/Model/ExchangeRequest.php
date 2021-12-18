<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Model;

use InvalidArgumentException;
use stdClass;

final class ExchangeRequest
{
    private string $name;
    private string $url;

    public function __construct(stdClass $decodedRequest)
    {
        $this->ensureDecodedRequestIsValid($decodedRequest);

        $this->name = $decodedRequest->name;
        $this->url = $decodedRequest->url;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param stdClass $decodedRequest
     * @return void
     * @throws InvalidArgumentException
     */
    private function ensureDecodedRequestIsValid(stdClass $decodedRequest): void
    {
        foreach ($this->getNeededProperties() as $property) {
            if (!property_exists($decodedRequest, $property)) {
                $messageTemplate = 'Expected property [%s] missing';
                throw new InvalidArgumentException(sprintf($messageTemplate, $property));
            }
        }
    }

    /**
     * @return string[]
     */
    private function getNeededProperties(): array
    {
        return ['name', 'url'];
    }
}
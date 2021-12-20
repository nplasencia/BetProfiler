<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Factory;

use Auret\BetProfiler\Model\RequestInterface;
use InvalidArgumentException;
use JsonException;
use stdClass;

abstract class AbstractRequestFactory implements RequestFactoryInterface
{
    /**
     * @return string[]
     */
    abstract protected function getNeededProperties(): array;

    abstract protected function returnRequest(stdClass $decodedRequest): RequestInterface;

    /**
     * @inheritDoc
     */
    public function create(string $jsonRequest): RequestInterface
    {
        $decodedRequest = $this->jsonDecode($jsonRequest);
        $this->ensureDecodedRequestIsValid($decodedRequest);

        return $this->returnRequest($decodedRequest);
    }

    /**
     * @throws JsonException
     */
    private function jsonDecode(string $jsonString): stdClass
    {
        return json_decode($jsonString, false, 512, JSON_THROW_ON_ERROR);
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
}
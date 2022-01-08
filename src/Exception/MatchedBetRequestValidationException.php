<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Exception;

use RuntimeException;

final class MatchedBetRequestValidationException extends RuntimeException
{
    public function __construct(string $errorMessage)
    {
        $message = sprintf('Validation has failed for MatchedBetRequest. Error: [%s]', $errorMessage);
        parent::__construct($message);
    }
}
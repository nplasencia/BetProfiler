<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Gateway;

use Auret\BetProfiler\Entity\Event;

interface EventGatewayInterface
{
    public function add(Event $event): Event;

    public function delete(int $id): void;
}
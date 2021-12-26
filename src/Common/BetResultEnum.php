<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Common;

enum BetResultEnum: string
{
    case WIN = 'win';
    case LOSE = 'lose';
}
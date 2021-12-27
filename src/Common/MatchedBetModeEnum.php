<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Common;

enum MatchedBetModeEnum: string
{
    case UNDERLAY = 'Underlay';
    case STANDARD = 'Standard';
    case OVERLAY = 'Overlay';
    case CUSTOM = 'Custom';
}
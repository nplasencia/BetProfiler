<?php declare(strict_types = 1);

namespace Auret\BetProfiler\Common;

enum MatchedBetTypeEnum: string
{
    case NORMAL = 'Normal';
    case SNR = 'Free (SNR)';
    case SR = 'Free (SR)';
    case RISK_FREE = 'Risk Free';
}
<?php

namespace App\Processors;

use App\Contracts\DataProcessor;
use ConsoleTVs\Profanity\Facades\Profanity;

class BadWords implements DataProcessor
{
    public static function process(string $data): string
    {
        return Profanity::blocker($data)->filter();
    }
}
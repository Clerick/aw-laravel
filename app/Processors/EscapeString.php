<?php

namespace App\Processors;

use App\Contracts\DataProcessor;

class EscapeString implements DataProcessor
{
    public static function process(string $data): string
    {
        return htmlentities($data);
    }
}
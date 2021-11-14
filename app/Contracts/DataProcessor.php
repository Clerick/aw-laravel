<?php

namespace App\Contracts;

interface DataProcessor
{
    public static function process(string $data): string;
}
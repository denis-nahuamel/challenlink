<?php

namespace App\Strategies;

use App\Interfaces\ImmutableItemStrategy;
use App\Constants\ItemNames;

class SulfurasStrategy implements ImmutableItemStrategy
{
    public function canHandle(string $itemName): bool
    {
        return $itemName === ItemNames::SULFURAS;
    }
}
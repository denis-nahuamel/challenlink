<?php

namespace App\Strategies;

use App\Interfaces\ImmutableItemStrategy;

class SulfurasStrategy implements ImmutableItemStrategy
{
    public function canHandle(string $itemName): bool
    {
        return $itemName === 'Sulfuras, Hand of Ragnaros';
    }
}
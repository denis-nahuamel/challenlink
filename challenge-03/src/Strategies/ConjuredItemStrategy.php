<?php

namespace App\Strategies;

use App\Item;
use App\Interfaces\ItemUpdateStrategy;
use App\Constants\ItemNames;

class ConjuredItemStrategy implements ItemUpdateStrategy
{
    public function update(Item $item): void
    {
        if ($item->quality > 0) {
            $item->decreaseQuality(min(2, $item->quality));
        }
        
        $item->decreaseSellIn();
        
        if ($item->isExpired() && $item->quality > 0) {
            $item->decreaseQuality(min(2, $item->quality));
        }
    }

    public function canHandle(string $itemName): bool
    {
        return $itemName === ItemNames::CONJURED;
    }
}
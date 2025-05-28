<?php

namespace App\Strategies;

use App\Item;
use App\Interfaces\ItemUpdateStrategy;
use App\Constants\ItemNames;

class AgedBrieStrategy implements ItemUpdateStrategy
{
    public function update(Item $item): void
    {
        if ($item->quality < 50) {
            $item->increaseQuality();
        }
        
        $item->decreaseSellIn();
        
        if ($item->isExpired() && $item->quality < 50) {
            $item->increaseQuality();
        }
    }

    public function canHandle(string $itemName): bool
    {
        return $itemName === ItemNames::AGED_BRIE;
    }
}
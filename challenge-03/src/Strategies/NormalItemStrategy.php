<?php

namespace App\Strategies;

use App\Item;
use App\Interfaces\ItemUpdateStrategy;
use App\Constants\ItemNames;

class NormalItemStrategy implements ItemUpdateStrategy
{
    public function update(Item $item): void
    {
        if ($item->quality > 0) {
            $item->decreaseQuality();
        }
        
        $item->decreaseSellIn();
        
        if ($item->isExpired() && $item->quality > 0) {
            $item->decreaseQuality();
        }
    }

    public function canHandle(string $itemName): bool
    {
        return !in_array($itemName, [
            ItemNames::BACKSTAGE_PASS,
            ItemNames::AGED_BRIE,
            ItemNames::SULFURAS,
            ItemNames::CONJURED,
        ]);
    }
}
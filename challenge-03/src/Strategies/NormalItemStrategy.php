<?php

namespace App\Strategies;

use App\Item;
use App\Interfaces\ItemUpdateStrategy;

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
            'Aged Brie',
            'Backstage passes to a TAFKAL80ETC concert',
            'Sulfuras, Hand of Ragnaros',
            'Conjured Mana Cake'
        ]);
    }
}
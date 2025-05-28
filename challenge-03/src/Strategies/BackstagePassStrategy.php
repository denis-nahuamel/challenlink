<?php

namespace App\Strategies;

use App\Item;
use App\Interfaces\ItemUpdateStrategy;

class BackstagePassStrategy implements ItemUpdateStrategy
{
    public function update(Item $item): void
    {
        $item->decreaseSellIn();
        
        if ($item->isExpired()) {
            $item->setQuality(0);
            return;
        }

        if ($item->quality < 50) {
            $item->increaseQuality();
            
            if ($item->sellIn < 10 && $item->quality < 50) {
                $item->increaseQuality();
            }
            
            if ($item->sellIn < 5 && $item->quality < 50) {
                $item->increaseQuality();
            }
        }
    }

    public function canHandle(string $itemName): bool
    {
        return $itemName === 'Backstage passes to a TAFKAL80ETC concert';
    }
}
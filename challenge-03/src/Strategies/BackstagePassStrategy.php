<?php

namespace App\Strategies;

use App\Item;
use App\Interfaces\ItemUpdateStrategy;
use App\Constants\ItemNames;

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
        return $itemName === ItemNames::BACKSTAGE_PASS;
    }
}
<?php

namespace App;

use App\Interfaces\ItemUpdateStrategy;

class ItemProcessor
{
    private ItemUpdateStrategyFactory $strategyFactory;

    public function __construct(?ItemUpdateStrategyFactory $strategyFactory = null)
    {
        $this->strategyFactory = $strategyFactory ?? new ItemUpdateStrategyFactory();
    }

    public function updateItem(Item $item): void
    {
        $strategy = $this->strategyFactory->getStrategy($item->getName());
        
        if ($strategy instanceof ItemUpdateStrategy) {
            $strategy->update($item);
        }
    }
}
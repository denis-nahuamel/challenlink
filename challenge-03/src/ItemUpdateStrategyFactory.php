<?php

namespace App;

use App\Interfaces\ItemStrategy;
use App\Interfaces\ItemUpdateStrategy;
use App\Interfaces\ImmutableItemStrategy;
use App\Strategies\AgedBrieStrategy;
use App\Strategies\BackstagePassStrategy;
use App\Strategies\ConjuredItemStrategy;
use App\Strategies\NormalItemStrategy;
use App\Strategies\SulfurasStrategy;

class ItemUpdateStrategyFactory
{
    private array $updateStrategies;
    private array $immutableStrategies;

    public function __construct()
    {
        $this->updateStrategies = [
            new AgedBrieStrategy(),
            new BackstagePassStrategy(),
            new ConjuredItemStrategy(),
            new NormalItemStrategy(),
        ];
        
        $this->immutableStrategies = [
            new SulfurasStrategy(),
        ];
    }

    public function getStrategy(string $itemName): ItemStrategy
    {
        foreach ($this->immutableStrategies as $strategy) {
            if ($strategy->canHandle($itemName)) {
                return $strategy;
            }
        }
        
        foreach ($this->updateStrategies as $strategy) {
            if ($strategy->canHandle($itemName)) {
                return $strategy;
            }
        }
        
        throw new \InvalidArgumentException("No strategy found for item: {$itemName}");
    }

    public function addUpdateStrategy(ItemUpdateStrategy $strategy): void
    {
        array_unshift($this->updateStrategies, $strategy);
    }
    
    public function addImmutableStrategy(ImmutableItemStrategy $strategy): void
    {
        array_unshift($this->immutableStrategies, $strategy);
    }
}
<?php

namespace App;

class GildedRose
{
    public string $name;
    public int $quality;
    public int $sellIn;
    
    private static ItemProcessor $processor;

    public function __construct(string $name, int $quality, int $sellIn)
    {
        $this->name = $name;
        $this->quality = $quality;
        $this->sellIn = $sellIn;
        
        if (!isset(self::$processor)) {
            self::$processor = new ItemProcessor();
        }
    }

    public static function of(string $name, int $quality, int $sellIn): self
    {
        return new self($name, $quality, $sellIn);
    }

    public function tick(): void
    {
        $item = new Item($this->name, $this->quality, $this->sellIn);
        
        self::$processor->updateItem($item);
        
        $this->quality = $item->quality;
        $this->sellIn = $item->sellIn;
    }
}
<?php
namespace App;

class Item
{
    public string $name;
    public int $quality;
    public int $sellIn;

    public function __construct(string $name, int $quality, int $sellIn)
    {
        $this->name = $name;
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public static function of(string $name, int $quality, int $sellIn): self
    {
        return new self($name, $quality, $sellIn);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }

    public function getSellIn(): int
    {
        return $this->sellIn;
    }

    public function setQuality(int $quality): void
    {
        $this->quality = max(0, min(50, $quality));
    }

    public function setSellIn(int $sellIn): void
    {
        $this->sellIn = $sellIn;
    }

    public function increaseQuality(int $amount = 1): void
    {
        $this->setQuality($this->quality + $amount);
    }

    public function decreaseQuality(int $amount = 1): void
    {
        $this->setQuality($this->quality - $amount);
    }

    public function decreaseSellIn(): void
    {
        $this->sellIn--;
    }

    public function isExpired(): bool
    {
        return $this->sellIn < 0;
    }
}

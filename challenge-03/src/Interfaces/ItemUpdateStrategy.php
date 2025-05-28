<?php

namespace App\Interfaces;

use App\Item;

interface ItemUpdateStrategy extends ItemStrategy
{
    public function update(Item $item): void;
}

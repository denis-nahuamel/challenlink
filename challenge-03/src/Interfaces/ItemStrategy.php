<?php

namespace App\Interfaces;

interface ItemStrategy
{
    public function canHandle(string $itemName): bool;
}
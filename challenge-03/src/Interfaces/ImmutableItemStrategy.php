<?php

namespace App\Interfaces;

interface ImmutableItemStrategy extends ItemStrategy
{
    // Immutable items only need to be identified, not updated.
    // The `canHandle` method from ItemStrategy is sufficient.
}
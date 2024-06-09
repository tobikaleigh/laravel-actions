<?php

namespace Tobikaleigh\Actions\Test\Models;

// Interfaces
use Tobikaleigh\Actions\Actionable;

// Traits
use Tobikaleigh\Actions\Traits\HasActions;

class SampleModel implements Actionable
{
    use HasActions;

    protected static $actions = [
        'sample-action'             => \Tobikaleigh\Actions\Test\Actions\SampleAction::class,
        'sample-queueable-action'   => \Tobikaleigh\Actions\Test\Actions\SampleQueableAction::class,

        'invalid-action'            => \Tobikaleigh\Actions\Test\Actions\InvalidAction::class,
    ];
}

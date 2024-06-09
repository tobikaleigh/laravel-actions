<?php

namespace Tobikaleigh\Actions;

use Illuminate\Support\Facades\Config;

abstract class QueueableAction extends Action
{
    public function viaConnection(): string
    {
        return Config::get('queues.actions.connection');
    }

    public function viaQueue(): string
    {
        return Config::get('queues.actions.queue');
    }
}

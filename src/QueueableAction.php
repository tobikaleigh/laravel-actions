<?php

namespace Tobikaleigh\Actions;

abstract class QueueableAction extends Action
{
    public function viaConnection(): string
    {
        return config('queues.actions.connection');
    }

    public function viaQueue(): string
    {
        return config('queues.actions.queue');
    }
}

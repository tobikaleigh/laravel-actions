<?php

namespace Tobikaleigh\Actions\Test\Actions;

use Tobikaleigh\Actions\QueueableAction;

class SampleQueableAction extends QueueableAction
{
    public function handle(): string
    {
        return 'success';
    }
}

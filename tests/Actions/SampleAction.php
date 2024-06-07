<?php

namespace Tobikaleigh\Actions\Test\Actions;

use Tobikaleigh\Actions\Action;

class SampleAction extends Action
{
    public function handle(): string
    {
        return 'success';
    }
}

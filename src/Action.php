<?php

namespace Tobikaleigh\Actions;

// Models
use Illuminate\Database\Eloquent\Model;

abstract class Action
{
    public function __construct(
        public Model $model
    ) {
    }

    abstract public function handle(): mixed;
}

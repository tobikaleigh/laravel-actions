<?php

namespace Tobikaleigh\Actions;

abstract class Action
{
    public function __construct(
        public Actionable $model
    ) {
    }

    abstract public function handle(): mixed;
}

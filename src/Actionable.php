<?php

namespace Tobikaleigh\Actions;

use Illuminate\Support\Collection;

interface Actionable
{
    public function actions(): Collection;
}

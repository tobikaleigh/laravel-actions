<?php

namespace Tobikaleigh\Actions\Test\Models;

use Illuminate\Database\Eloquent\Model;

class SampleModel extends Model
{
    protected static $actions = [
        'sample-action'     => \Tobikaleigh\Actions\Test\Actions\SampleAction::class,
    ];
}

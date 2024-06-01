<?php

use Tobikaleigh\Actions\Test\Models\SampleModel as Model;

it('can run a sample action', function () {
    $model  = Model::create(['name' => 'sample']);
    $output = $model->runAction('sample-action');

    expect($output)->toBe('success');
});

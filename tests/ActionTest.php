<?php

use Tobikaleigh\Actions\Test\Models\SampleModel;

it('can run a sample action', function () {
    $model  = new SampleModel();
    $output = $model->runAction('sample-action');

    expect($output)->toBe('success');
});

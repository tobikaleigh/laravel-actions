<?php

use Tobikaleigh\Actions\Test\Models\SampleModel;

it('can run a sample action', function () {
    $object  = new SampleModel();
    $output = $object->runAction('sample-action');

    expect($output)->toBe('success');
});

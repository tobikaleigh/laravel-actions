<?php

use Tobikaleigh\Actions\Test\Models\SampleModel;

// Exceptions
use Tobikaleigh\Actions\Exceptions\NotFoundException;
use Tobikaleigh\Actions\Exceptions\InvalidException;

it('can run a sample action', function () {
    $model  = new SampleModel();
    $output = $model->runAction('sample-action');

    expect($output)->toBe('success');
});

it('will throw an exception if action is not found', function () {
    $model = new SampleModel();

    $model->runAction('non-existent-action');
})->throws(NotFoundException::class);

it('will throw an exception if action does not extend Action', function () {
    $model = new SampleModel();

    $model->runAction('invalid-action');
})->throws(InvalidException::class);

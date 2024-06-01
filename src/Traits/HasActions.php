<?php

namespace Tobikaleigh\Actions\Traits;

use Tobikaleigh\Actions\Action;
use Tobikaleigh\Actions\QueueableAction;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Bus\PendingDispatch;

// Exceptions
use Throwable;
use Tobikaleigh\Actions\Exceptions\InvalidAction;

// Jobs
use Tobikaleigh\Actions\Jobs\ActionJob;

trait HasActions
{
    public bool $enableLoggingModelActions = true;

    private function actions(): Collection
    {
        if (isset(static::$actions)) {
            return collect(static::$actions);
        }

        return collect([]);
    }

    private function resolveAction(string $name, ...$args): Action
    {
        $action = $this->actions()->get($name);

        if (is_null($action)) {
            throw new InvalidAction('Action ' . $name . ' not found for ' . class_basename($this) . '.');
        }

        $action = new $action($this, ...$args);

        if (!$action instanceof Action) {
            throw new InvalidAction('Action ' . $action::class . ' should extend' . Action::class . '.');
        }

        return $action;
    }

    public function logActionErrorEvent(Action $action, Throwable $exception): void
    {
        if ($this->enableLoggingModelActions) {
            $class = class_basename($action);

            activity()
                ->performedOn($this)
                ->event('action.' . str()->snake($class))
                ->withProperty('exception', [
                    'message'   => $exception->getMessage(),
                    'code'      => $exception->getCode(),
                ])
                ->withProperty('queued', $action instanceof QueueableAction)
                ->log(str()->headline($class) . ' Error.');
        }
    }

    /**
     * Get the queues for the actions.
     */
    protected function actionViaQueues(): array
    {
        return [];
    }

    public function disableActionLogging(): self
    {
        $this->enableLoggingModelActions = false;

        return $this;
    }

    public function enableActionLogging(): self
    {
        $this->enableLoggingModelActions = true;

        return $this;
    }

    public function runAction(string $name, ...$args): mixed
    {
        $action = $this->resolveAction($name, ...$args);

        try {
            $handle = $action->handle();
        } catch (Throwable $exception) {
            $this->logActionErrorEvent($action, $exception);

            throw $exception;
        }

        return $handle;
    }

    public function queueAction(string $name, ...$args): PendingDispatch
    {
        $action = $this->resolveAction($name, ...$args);

        if (!$action instanceof QueueableAction) {
            throw new InvalidAction('Queued action ' . $action::class . ' should extend' . QueueableAction::class . '.');
        }

        $queue = $this->actionViaQueues()[$name] ?? $action->viaQueue();

        return ActionJob::dispatch($this, $action)
            ->onConnection($action->viaConnection())
            ->onQueue($queue);
    }
}

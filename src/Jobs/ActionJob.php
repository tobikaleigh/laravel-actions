<?php

namespace Tobikaleigh\Actions\Jobs;

use Throwable;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Models
use Illuminate\Database\Eloquent\Model;

class ActionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Model $model,
        public Action $action,
    ) {
    }

    /**
     * Get the display name for the queued job.
     */
    public function displayName(): string
    {
        return $this->action::class;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->action->handle();
    }

    /**
     * Handle a job failure.
     */
    public function failed(Throwable $exception): void
    {
        $model = $this->model;

        $model->logActionErrorEvent($this->action, $exception);

        throw $exception;
    }
}

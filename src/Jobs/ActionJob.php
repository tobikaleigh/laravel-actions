<?php

namespace Tobikaleigh\Actions\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Tobikaleigh\Actions\Actionable;
use Tobikaleigh\Actions\Action;

class ActionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Actionable $model,
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
}

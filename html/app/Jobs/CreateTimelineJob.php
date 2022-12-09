<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateTimelineJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The validated data
     */
    protected $validated;

    /**
     * The user api_key
     */
    protected $api_key;

    /**
     * Create a new job instance.
     *
     * @param array $validated
     * @param string $api_key
     * @return void
     */
    public function __construct(array $validated, string $api_key)
    {
        $this->validated = $validated;
        $this->api_key = $api_key;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Run job", $this->validated);
    }
}

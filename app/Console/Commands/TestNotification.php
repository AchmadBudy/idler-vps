<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NotificationService;

class TestNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:test {message=Test Message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the Notification Service';

    /**
     * Execute the console command.
     */
    public function handle(NotificationService $notificationService)
    {
        $message = $this->argument('message');
        $this->info("Sending notification: $message");

        // Test Send All
        $this->info("Attempting to send to all enabled channels...");
        $notificationService->sendAll("Test Notification", $message);
        
        $this->info("Process finished. Check your logs or channels if configured.");
    }
}

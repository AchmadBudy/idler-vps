<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Domain;
use App\Models\Misc;
use App\Models\Server;
use App\Models\Shared;
use App\Services\NotificationService;
use Illuminate\Console\Command;

final class checkExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check expired All Services';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $datas = [
            'domains' => Domain::query()
                ->stillOwned()
                ->whereDate('due_at', '<=', now()->addWeeks(2))
                ->get(),
            'miscs' => Misc::query()
                ->stillOwned()
                ->whereDate('due_at', '<=', now()->addWeeks(2))
                ->get(),
            'servers' => Server::query()
                ->stillOwned()
                ->whereDate('due_at', '<=', now()->addWeeks(2))
                ->get(),
            'shareds' => Shared::query()
                ->stillOwned()
                ->whereDate('due_at', '<=', now()->addWeeks(2))
                ->get(),
        ];

        foreach ($datas as $key => $value) {
            $this->info('Starting to check '.$key);

            // check if there's no result skip
            if ($value->isEmpty()) {
                $this->info('No expired '.$key.' found');

                continue;
            }

            $value->each(function ($item) use ($key) {
                $this->info('Expired '.$key.' found: '.$item->name);

                // sending info notify
                (new NotificationService(
                    subject: 'Expired '.$key.' found: '.$item->name,
                    message: 'Expired '.$key.' found: '.$item->name.'. Expire at: '.$item->due_at->toDateString()
                ))->sendAll();

                // cooldown 1sec
                sleep(1);
            });
        }

        $this->info('Finish checking on this session');
    }
}

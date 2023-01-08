<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;

class CheckLicense extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'license:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update the outdated license status';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Searching for Outdated trials...');

        $tenants = Tenant::where('created_at', '<', now()->subMonths(3))->where('status', 'trial')->get();

        foreach ($tenants as $tenant) {
            $tenant->setStatus("inactive");
        }

        $this->info('Data updated');
        return Command::SUCCESS;
    }
}

<?php

namespace App\Console\Commands;

use App\Jobs\TCMBCurrencyFeedJob;
use Illuminate\Console\Command;

class TCMBCurrencyFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tcmb:currency-feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'TCMB Currency Feed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        TCMBCurrencyFeedJob::dispatch()->onQueue('tcmb-currency');
        $this->info('tcmb currencies queue sent');
        return self::SUCCESS;
    }
}

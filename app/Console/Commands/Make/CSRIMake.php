<?php

namespace App\Console\Commands\Make;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CSRIMake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:csri {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Controller, Service, Repository, Interface';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $name = $this->argument('name');
        Artisan::call('make:service-controller '. $name);
        Artisan::call('make:service '. $name);
        Artisan::call('make:repository '. $name);
        Artisan::call('make:repository-interface '. $name);
        $this->info('Controller, Service, Repository, Interface created successfully');
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrationDataBase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:full';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all the tables with their respective seeder taking into account the modules';

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
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
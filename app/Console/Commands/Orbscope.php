<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Orbscope extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orbscope';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Cache, View, Config, routes and optimize';

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
        $this->call("cache:clear");
        $this->call("view:clear");
        $this->call("config:clear");
        $this->call("route:clear");
        $this->call("clear-compiled");
        $this->call("optimize");
    }
}

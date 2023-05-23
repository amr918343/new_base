<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dependencies:install';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install dependencies for Laravel Echo';

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
     * @return int
     */
    public function handle()
    {
        // Prompt the user to choose a Redis version
        $redisVersion = $this->ask('Which version of Redis do you want to install?', 'latest');

        $this->info("Installing Redis version $redisVersion...");
        exec("sudo apt-get install redis-server=$redisVersion -y");

        $this->info('Installing Socket.IO...');
        exec('npm install socket.io');

        $this->info('Dependencies installed successfully!');
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
class CreateServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new service class';

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
        $classNameArgument = $this->argument('class');
        $className = substr(strrchr($classNameArgument, "/"), 1);
        $path = base_path('app/Services/' . $classNameArgument . '.php');
        $namespace =  str_replace('/', '\\', str_replace('/' . $className, '', app()->getNamespace() . 'Services/' . $classNameArgument));

        $content =
'<?php
namespace App\\Services\\' . $namespace . ';

class ' .  $className . ' {

}
'
;
        if (file_exists($path)) {
            $this->error('Service already exists: ' . $className);
            return;
        }

        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        file_put_contents($path, $content);
    }
}

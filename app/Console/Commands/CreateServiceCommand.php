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
        $className = $this->argument('class');
        $path = base_path('Services/' . $className . '.php');
        $classNamespace = str_replace('/', '\\', $className);
        $className = substr($classNamespace, strpos($classNamespace, '\\') + 1);
        $content =
'<?php
namespace App\\Services\\' . $classNamespace . ';

class ' .  $className . ' {

}
'
;
        if(file_exists($path)) {
            $this->error('Service already exists: ' . $className);
            return;
        }
        if(file_exists(dirname($path))) {
            mkdir($path, 0777, true);
        } else {
            mkdir(dirname($path), 0777, true);
        }
        file_put_contents($path, $content);
    }
}

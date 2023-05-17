<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AutomatedFeatureTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto create an initialized feature test from an exisiting controller';

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
        $controller = $this->argument('controller');
        $className = Str::studly($controller . 'Test');

        $testPath = base_path('tests/Feature/' . $className . '.php');
        $controllerPath = app_path('Http/Controllers/' . $controller . '.php');

        if (!File::exists($controllerPath)) {
            $this->error('Controller does not exist: ' . $controller);
            return;
        }

        if (File::exists($testPath)) {
            $this->error('Test already exists: ' . $className);
            return;
        }

        $controllerInstance = app($controller);
        $reflection = new ReflectionClass($controllerInstance);
        $methods = collect($reflection->getMethods(ReflectionMethod::IS_PUBLIC))
                    ->pluck('name')
                    ->reject(function ($name) {
                        return Str::startsWith($name, '__');
                    });

        $testContent = view('feature-test', [
            'className' => $className,
            'controller' => $controller,
            'methods' => $methods,
        ])->render();

        File::put($testPath, $testContent);

        $this->info('Feature test created: ' . $className);

        Artisan::call('test', ['--filter' => $methods->implode('|')]);
    }
}

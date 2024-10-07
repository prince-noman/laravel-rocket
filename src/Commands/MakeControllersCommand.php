<?php

namespace PrinceNoman\LaravelRocket\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeControllersCommand extends Command
{
    protected $signature = 'make:controllers {names*} {--r|resource : Create a resource controller}';
    protected $description = 'Create multiple controllers';

    public function handle()
    {
        $names = $this->argument('names');
        
        $isResource = $this->option('resource'); 

        foreach ($names as $name) {
            $controllerPath = app_path("Http/Controllers/{$name}Controller.php");

            if (File::exists($controllerPath)) {
                $this->warn("Controller {$name}Controller already exists.");
                continue; 
            }

            if ($isResource) {
                $this->call('make:controller', [
                    'name' => "{$name}Controller",
                    '--resource' => true, 
                ]);
                $this->info("Resource controller {$name}Controller created successfully.");
            } else {
                $this->call('make:controller', [
                    'name' => "{$name}Controller",
                ]);
                $this->info("Controller {$name}Controller created successfully.");
            }
        }
    }
}
<?php

namespace PrinceNoman\LaravelRocket\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeFactoriesCommand extends Command
{
    protected $signature = 'make:factories {names*}';
    protected $description = 'Create factories for multiple models';

    public function handle()
    {
        $names = $this->argument('names');

        foreach ($names as $name) {
            $factoryPath = database_path("factories/{$name}Factory.php");

            if (File::exists($factoryPath)) {
                $this->warn("Factory for {$name} already exists.");
                continue;
            }

            $this->call('make:factory', [
                'name' => "{$name}Factory",
                '--model' => $name,
            ]);

            $this->info("Factory for {$name} created successfully.");
        }
    }
}
<?php

namespace PrinceNoman\LaravelRocket\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModelsCommand extends Command
{
    protected $signature = 'make:models {names*} {--m|migration}';
    protected $description = 'Create multiple models and optionally migrations';

    public function handle()
    {
        $names = $this->argument('names');
        $createMigrations = $this->option('migration');

        foreach ($names as $name) {
            $modelExists = $this->modelExists($name);

            $migrationExists = $createMigrations ? $this->migrationExists($name) : false;

            if ($modelExists) {
                $this->warn("Model {$name} already exists.");
            } else {
                $this->call('make:model', [
                    'name' => $name,
                    '--migration' => $createMigrations && !$migrationExists, 
                ]);
                $this->info("Model {$name} created successfully.");
            }

            if ($createMigrations && !$migrationExists && !$modelExists) {
                $this->info("Migration for {$name} created successfully.");
            } elseif ($migrationExists) {
                $this->warn("Migration for {$name} already exists.");
            }
        }
    }

    /**
     * Check if the model file already exists in the app/Models directory.
     *
     * @param string $name
     * @return bool
     */
    protected function modelExists($name)
    {
        $modelPath = app_path("Models/{$name}.php");
        return File::exists($modelPath);
    }

    /**
     * Check if the migration file already exists in the database/migrations directory.
     *
     * @param string $name
     * @return bool
     */
    protected function migrationExists($name)
    {
        $migrationFileName = "create_" . strtolower($name) . "_table";
        $migrationsPath = database_path('migrations');

        $migrationFiles = File::files($migrationsPath);
        foreach ($migrationFiles as $file) {
            if (strpos($file->getFilename(), $migrationFileName) !== false) {
                return true;
            }
        }

        return false;
    }
}
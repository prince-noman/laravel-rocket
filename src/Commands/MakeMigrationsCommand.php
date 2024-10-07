<?php

namespace PrinceNoman\LaravelRocket\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeMigrationsCommand extends Command
{
    protected $signature = 'make:migrations {names*}';
    protected $description = 'Create migrations for multiple models';

    public function handle()
    {
        $names = $this->argument('names');
        foreach ($names as $name) {
            $tableName = Str::snake(Str::pluralStudly($name));
            $migrationFileName = "create_{$tableName}_table";

            $existingMigration = $this->migrationExists($migrationFileName);

            if ($existingMigration) {
                $this->warn("Migration for {$name} already exists: {$existingMigration}");
                continue; 
            }

            $this->call('make:migration', [
                'name' => $migrationFileName
            ]);
            $this->info("Migration for {$name} created successfully.");
        }
    }

    /**
     * Check if a migration already exists by searching the migrations directory.
     *
     * @param string $migrationName
     * @return string|false The migration file name if it exists, or false if it doesn't
     */
    protected function migrationExists($migrationName)
    {
        $migrationFiles = File::files(database_path('migrations'));

        foreach ($migrationFiles as $file) {
            if (Str::contains($file->getFilename(), $migrationName)) {
                return $file->getFilename(); 
            }
        }

        return false;
    }
}
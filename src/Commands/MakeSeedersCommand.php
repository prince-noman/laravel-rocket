<?php

namespace PrinceNoman\LaravelRocket\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeSeedersCommand extends Command
{
    protected $signature = 'make:seeders {names*}';
    protected $description = 'Create multiple seeders';

    public function handle()
    {
        $names = $this->argument('names');
        foreach ($names as $name) {
            if ($this->seederExists($name)) {
                $this->warn("Seeder for {$name}Seeder already exists.");
                continue;
            }

            $this->call('make:seeder', [
                'name' => "{$name}Seeder",
            ]);
            $this->info("Seeder for {$name} created successfully.");
        }
    }

    /**
     * Check if the seeder file already exists in the database/seeders directory.
     *
     * @param string $name
     * @return bool
     */
    protected function seederExists($name)
    {
        $seederPath = database_path("seeders/{$name}Seeder.php");
        return File::exists($seederPath);
    }
}
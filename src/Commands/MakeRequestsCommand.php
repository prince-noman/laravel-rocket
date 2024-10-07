<?php

namespace PrinceNoman\LaravelRocket\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRequestsCommand extends Command
{
    protected $signature = 'make:requests {names*}';
    protected $description = 'Create multiple form request classes';

    public function handle()
    {
        $names = $this->argument('names');
        foreach ($names as $name) {
            if ($this->requestExists($name)) {
                $this->warn("Request {$name}Request already exists.");
                continue;
            }

            $this->call('make:request', [
                'name' => "{$name}Request",
            ]);
            $this->info("Request {$name}Request created successfully.");
        }
    }

    /**
     * Check if the request file already exists in the app/Http/Requests directory.
     *
     * @param string $name
     * @return bool
     */
    protected function requestExists($name)
    {
        $requestPath = app_path("Http/Requests/{$name}Request.php");
        return File::exists($requestPath);
    }
}
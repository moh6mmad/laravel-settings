<?php

namespace Moh6mmad\LaravelSettings\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallLaravelSettings extends Command
{
    protected $signature = 'laravelsettings:install';
    protected $description = 'Install the BlogPackage';

    public function handle()
    {
        $this->info('Installing BlogPackage...');
        $this->publishConfiguration();         
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Moh6mmad\LaravelSettings\LaravelSettingsServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

       $this->call('vendor:publish', $params);
    }
}
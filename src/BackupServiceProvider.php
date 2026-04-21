<?php

namespace LampDevs\Backup;

use Illuminate\Support\ServiceProvider;

class BackupServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/backup.php', 'backup');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/backup.php' => config_path('backup.php'),
        ], 'backup-config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \LampDevs\Backup\Console\BackupCommand::class,
            ]);
        }
    }
}
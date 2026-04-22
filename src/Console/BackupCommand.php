<?php

namespace LampDevs\Backup\Console;

use Illuminate\Console\Command;
use LampDevs\Backup\Services\BackupManager;
use ZipArchive;

class BackupCommand extends Command
{
    protected $signature = 'lamp:backup';
    protected $description = 'Full lampeDev Backup (DB + Files + Zip)';

    public function handle()
    {
        $date = date('Y-m-d-His');

        $base = config('backup.path')."/backup-{$date}";

        mkdir($base, 0775, true);

        $manager = new BackupManager();

        $this->info("Starting backup...");

        // DB
        $manager->database("$base/database.sql");
        $this->info("Database backed up");

        // ENV
        copy(base_path('.env'), "$base/.env");

        // Storage
        if (config('backup.files')) {
            $manager->copyFolder(storage_path('app'), "$base/storage");
            $manager->copyFolder(app_path(), "$base/app");
        }

        // ZIP
        if (config('backup.zip')) {
            $this->zip($base);
        }

        $this->info("Backup completed successfully");
    }

    private function zip($base)
    {
        $zip = new ZipArchive();
        $zipFile = $base.'.zip';

        if ($zip->open($zipFile, ZipArchive::CREATE)) {

            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($base),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $file) {
                if (!$file->isDir()) {

                    $filePath = $file->getRealPath();

                    $relative = substr($filePath, strlen($base) + 1);

                    $zip->addFile($filePath, $relative);
                }
            }

            $zip->close();
        }
    }
}
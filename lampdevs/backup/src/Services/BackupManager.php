<?php

namespace LampDevs\Backup\Services;

class BackupManager
{
    public function database($file)
    {
        $driver = config('database.default');

        if ($driver === 'pgsql') {

            $host = config('database.connections.pgsql.host');
            $port = config('database.connections.pgsql.port');
            $db   = config('database.connections.pgsql.database');
            $user = config('database.connections.pgsql.username');
            $pass = config('database.connections.pgsql.password');

            $cmd = "PGPASSWORD='{$pass}' pg_dump -h {$host} -p {$port} -U {$user} {$db} > {$file}";

        } else {

            $host = config('database.connections.mysql.host');
            $db   = config('database.connections.mysql.database');
            $user = config('database.connections.mysql.username');
            $pass = config('database.connections.mysql.password');

            $cmd = "mysqldump -h {$host} -u {$user} -p{$pass} {$db} > {$file}";
        }

        exec($cmd);
    }

    public function copyFolder($source, $dest)
    {
        if (!is_dir($dest)) mkdir($dest, 0775, true);

        foreach (scandir($source) as $file) {

            if ($file === '.' || $file === '..') continue;

            if (is_dir("$source/$file")) {
                $this->copyFolder("$source/$file", "$dest/$file");
            } else {
                copy("$source/$file", "$dest/$file");
            }
        }
    }
}
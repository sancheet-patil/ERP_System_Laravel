<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DailyDbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:backupdb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Database backup at 2358';

    protected $process;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $database = config('database.connections.mysql.database');
        $backupPath = 'backups/db_'.date('ymdHis').'.sql';

        if(!is_dir(storage_path('backups'))) {
            mkdir(storage_path('backups'));
        }
        $this->process = new Process(sprintf(
            'mysqldump --compact --skip-comments -u%s -p%s %s > %s',$username,$password,$database,storage_path($backupPath)
        ));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try
        {
            $this->process->mustRun();
            Log::info('Daily Backup success');
        }
        catch (ProcessFailedException $exception)
        {
            Log::error('Daily Backup failed: ',$exception);
        }
    }
}

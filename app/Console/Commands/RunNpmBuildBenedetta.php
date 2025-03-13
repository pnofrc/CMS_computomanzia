<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
class RunNpmBuildBenedetta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'npm:benedetta';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $command = 'cd /var/www/vhost/in-sospeso.com/benedettastefani.it/';
        shell_exec($command);
        $command2 = 'npm run build';
        shell_exec($command2);


        // $process = new Process(['npm', 'run', 'build']);
        // $process->setWorkingDirectory($dir); 
        // $process->run();

        // if (!$process->isSuccessful()) {
        //     throw new ProcessFailedException($process);
        // }

        $this->info('Build completata con successo!');
    }
}

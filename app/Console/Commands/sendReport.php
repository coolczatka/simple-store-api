<?php

namespace App\Console\Commands;

use App\Jobs\sendReportMail;
use Illuminate\Console\Command;

class sendReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        sendReportMail::dispatch();
        echo "<info>Mails are sending</info>";
    }
}

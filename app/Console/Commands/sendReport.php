<?php

namespace App\Console\Commands;

use App\Custom\Report;
use App\Mail\ReportMail;
use App\User;
use Illuminate\Console\Command;

class sendReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
        $admins = User::where('role','=',True)->get();
        $report = new Report();
        $pdf = $report->generate();
        foreach ($admins as $admin){
            Mail::to($admin->email)->send(new ReportMail($pdf));
        }
    }
}

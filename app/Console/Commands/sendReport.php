<?php

namespace App\Console\Commands;

use App\Custom\Report;
use App\Mail\ReportMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Output\ConsoleOutput;

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
        $admins = User::where('role','=',True)->get();
        $report = new Report();
        $pdf = $report->generate();
        $pdf->save(public_path('file.pdf'));
        foreach ($admins as $admin){
            Mail::to($admin->email)->send(new ReportMail(public_path('/file.pdf')));
            Log::info("Raport send to ".$admin->email);

        }
        echo "Raport send to admins";
        unlink(public_path('/file.pdf'));
    }
}

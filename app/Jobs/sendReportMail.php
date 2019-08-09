<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Mail\ReportMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Custom\Report;

class sendReportMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
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

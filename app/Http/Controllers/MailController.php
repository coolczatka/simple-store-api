<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Custom\Report;
use App\User;

class MailController extends Controller
{
    public function sendReport(){
        $report = new Report();
        $pdf = $report->generate();
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Karol
 * Date: 07.08.2019
 * Time: 19:23
 */

namespace App\Custom;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use PDF;
use Illuminate\Support\Facades\DB;

class Report
{

    private $bestSellingProductName;
    private $bestSellingProductAmount;
    private $sumOfPrices;


    public function __construct()
    {
        $this->bestSellingProductName = $this->bestSellingProductYesterday();
        $this->bestSellingProductAmount = $this->numberOfBestSellingProducts();
        $this->sumOfPrices = $this->sumOfYesterday();
    }

    private static function bestSellingProductYesterday():String{
        $raw = DB::raw('select name from bestSellingProduct');
        return $raw->getValue();
    }
    private static function numberOfBestSellingProducts(){
        $raw = DB::raw('select total from bestSellingProduct');
        return $raw->getValue();
    }
    private static function sumOfYesterday(){
        $raw = DB::raw('select sum from sum_of_yesterday');
        return $raw->getValue();
    }

    public function generate(){
        $html = "<h1>Report ".(Carbon::now()->sub(1,'day')).'</h1></br>';
        $html .= "Best selling product yesterday was ".$this->bestSellingProductName;
        $html .= '</br>'."Best selling product order amount was ".$this->bestSellingProductAmount;
        $html .= "</br>"."Sum of purchase price was ".$this->sumOfPrices;
        $pdf = PDF::loadHtml($html);
        return $pdf;
    }


}
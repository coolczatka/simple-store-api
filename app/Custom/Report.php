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
    /**
     * @return string
     */
    public function getBestSellingProductName(): string
    {
        return $this->bestSellingProductName;
    }

    /**
     * @return string
     */
    public function getBestSellingProductAmount(): string
    {
        return $this->bestSellingProductAmount;
    }

    /**
     * @return int
     */
    public function getSumOfPrices(): ?float
    {
        return $this->sumOfPrices;
    }

    private $bestSellingProductName;
    private $bestSellingProductAmount;
    private $sumOfPrices;


    public function __construct()
    {
        $this->bestSellingProductName = $this->bestSellingProductYesterday();
        $this->bestSellingProductAmount = $this->numberOfBestSellingProducts();
        $this->sumOfPrices = $this->sumOfYesterday();
    }

    public static function bestSellingProductYesterday():?String{
        $raw = DB::select(DB::raw('select name from bestSellingProduct'));
        if(count($raw)==0)
            return "nothing";
        return $raw[0]->name;
    }
    public static function numberOfBestSellingProducts(){
        $raw = DB::select(DB::raw('select total from bestSellingProduct'));
        if(count($raw)==0)
            return 0;
        return $raw[0]->total;
    }
    public static function sumOfYesterday():?float{
        $raw = DB::select(DB::raw('select sum from sum_of_yesterday'));
        if(count($raw)==0){
            return 0;
        }
        return $raw[0]->sum;
    }

    public function generate(){
        $html = "<h1>Report ".(Carbon::now()->sub(1,'day')).'</h1></br>';
        $html .= "<div>Best selling product yesterday was ".$this->bestSellingProductName."</div>";
        $html .= "<div>Best selling product order amount was ".$this->bestSellingProductAmount."</div>";
        $html .= "<div>Sum of purchase price was ".$this->sumOfPrices."</div>";
        $pdf = PDF::loadHtml($html);
        return $pdf;
    }


}
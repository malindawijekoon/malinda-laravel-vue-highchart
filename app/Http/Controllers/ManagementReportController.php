<?php

namespace App\Http\Controllers;

use App\Services\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class ManagementReportController extends Controller
{

    protected $weeklyCohorts = [];
    protected $weekArray = [];

    protected $step_0_count = 0;
    protected $step_1_count = 0;
    protected $step_2_count = 0;
    protected $step_3_count = 0;
    protected $step_4_count = 0;
    protected $step_5_count = 0;
    protected $step_6_count = 0;
    protected $step_7_count = 0;
    protected $step_8_count = 0;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $fileName = storage_path('app/export.csv');


        Excel::load($fileName)->each(function (Collection $csvLine){


            foreach ($csvLine->toArray() as $key => $row)
            {
                $row = explode(";",$row);

                $date = Carbon::parse($row[1]);
                $currentWeekNumber = $date->weekOfYear;


                if (($row[2] == 0) || ($row[2] == '')) {
                    $this->step_1_count++;
                }
                elseif ($row[2] <= 20) {
                    $this->step_2_count++;
                }
                elseif (($row[2] > 20) && ($row[2] <= 40)) {
                    $this->step_3_count++;
                }
                elseif (($row[2] > 40) && ($row[2] <= 50)) {
                    $this->step_4_count++;
                }
                elseif (($row[2] > 50) && ($row[2] <= 70)) {
                    $this->step_5_count++;
                }
                elseif (($row[2] > 70) && ($row[2] <= 90)) {
                    $this->step_6_count++;
                }
                elseif (($row[2] > 90) && ($row[2] <= 99)) {
                    $this->step_7_count++;
                }
                elseif ($row[2] == 100) {
                    $this->step_8_count++;
                }

                if($row[2] <= 100){
                    $this->step_0_count++;
                }

                // Sum all the steps
                for($i=0; $i<=8; $i++){
                    $this->weeklyCohorts[$currentWeekNumber]['step_'.$i.'_count'] = $this->{'step_'.$i.'_count'};
                }
            }
        });

        $keySet = array_keys($this->weeklyCohorts);

        $firstKey = reset($keySet);
        $lastKey = end($keySet);


        for ( $i=$firstKey; $i <= $lastKey;  $i++) {

            if($i == $firstKey){

                //Get weekly records
                for($x=0; $x<=8; $x++){
                    $this->weekArray[$i]['step_'.$x.'_count'] = $this->weeklyCohorts[$i]['step_'.$x.'_count'];
                }
            }
            else {
                for($x=0; $x<=8; $x++){
                    $this->weekArray[$i]['step_'.$x.'_count'] = $this->weeklyCohorts[$i]['step_'.$x.'_count'] - $this->weeklyCohorts[$i-1]['step_'.$x.'_count'];
                }
            }

        }

        # Setting the chart
        $chartData = Report::getReportData();

        foreach($this->weekArray as $week => $value){

            $dataSeries = array();

            for($i=1; $i<=8; $i++)
            {
                if($i == 1){
                    $dataSeries[] = 100;
                }
                else {
                    $dataSeries[] = round($value['step_'.$i.'_count'] / $value['step_0_count'] * 100);
                }
            }
            # charts DataSet
            $chartData ["series"] [] = array (
                "name" => 'Week - '.$week,
                "data" => $dataSeries
            );
        }

        return response()->json([$chartData])->setEncodingOptions(JSON_NUMERIC_CHECK);

    }
}

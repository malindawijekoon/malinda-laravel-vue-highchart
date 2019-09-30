<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getData(){



        # chart type
        $chartArray ["chart"] = array (
            "type" => "spline"
        );
        # chart title
        $chartArray ["title"] = array (
            "text" => "Weekly Retention Curve of Temper Onboarding Flow"
        );
        # chart subtitle
        $chartArray ["subtitle"] = array (
            "text" => "Develop by Highcharts and Vuejs"
        );
        # charts Legend
        $chartArray ["legend"] = array (
            "layout" => "vertical",
            "align" => "right",
            "verticalAlign" => "middle"
        );
        # charts credits
        $chartArray ["credits"] = array (
            "enabled" => false
        );
        # charts xAxis as categories
        $chartArray ["xAxis"] = array (
            "categories" => array ()
        );
        # charts tooltip
        $chartArray ["tooltip"] = array (
            "valueSuffix" => "%"
        );

        # charts xAxis categories
        $categoryArray = array (
            '0',
            '20',
            '40',
            '50',
            '70',
            '90',
            '99',
            '100'
        );


        $chartArray ["xAxis"] = array (
            "categories" => $categoryArray,
            "title" => array (
                "text" => "Step in the Onboarding"
            )
        );


        # charts yAxis
        $chartArray ["yAxis"] = array (
            "title" => array (
                "text" => "Percentage of Users (Entire Onboarded)"
            ),
            'labels' => array(
                'format' => '{value}%'
            ),
            'min' => '0',
            'max' => '100'
        );


        # Disable heightcharts marker
        $chartArray ["plotOptions"] = array (
            "series" => array (
                "marker" => array (
                    "enabled" => false
                ),
            )
        );
        # charts DataSet
        $chartArray ["series"] [] = array (
            "name" => 1,
            "data" => 25
        );



        return response()->json([$chartArray])->setEncodingOptions(JSON_NUMERIC_CHECK);

    }
}

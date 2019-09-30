<?php


namespace App\Services;


class Report
{

    public static function getReportData(){

        # chart type
        $chartData ["chart"] = array (
            "type" => "spline"
        );
        # chart title
        $chartData ["title"] = array (
            "text" => "Weekly Retention Curve of Temper Onboarding Flow"
        );
        # chart subtitle
        $chartData ["subtitle"] = array (
            "text" => "Develop by Highcharts and Vuejs"
        );
        # charts Legend
        $chartData ["legend"] = array (
            "layout" => "vertical",
            "align" => "right",
            "verticalAlign" => "middle"
        );
        # charts credits
        $chartData ["credits"] = array (
            "enabled" => false
        );
        # charts xAxis as categories
        $chartData ["xAxis"] = array (
            "categories" => array ()
        );
        # charts tooltip
        $chartData ["tooltip"] = array (
            "valueSuffix" => "%"
        );

        # charts xAxis categories
        $categoryArray = array (
            '0','20','40','50','70','90','99','100'
        );


        $chartData ["xAxis"] = array (
            "categories" => $categoryArray,
            "title" => array (
                "text" => "Step in the Onboarding"
            )
        );


        # charts yAxis
        $chartData ["yAxis"] = array (
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
        $chartData ["plotOptions"] = array (
            "series" => array (
                "marker" => array (
                    "enabled" => false
                ),
            )
        );

        return $chartData;
    }


}
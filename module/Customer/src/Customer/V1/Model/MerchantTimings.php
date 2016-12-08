<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 4/20/2016
 * Time: 7:30 PM
 */

namespace Customer\V1\Model;

class MerchantTimings {

    private $serviceLocator;

    function __construct($serviceLocator){
        $this->serviceLocator = $serviceLocator;
    }

    function getDisplayTimingsByTimingString($timing_sript){
        $timings = json_decode($timing_sript, true);

        $new_timings = $this->getTimingsByShortKeys($timings);

        $display_timings  = " ";

        $timings_keys = array_keys($new_timings);

        $timings_values = array_values($new_timings);

        for($i=0; $i< count($timings_keys); $i++){
            $temp_display_time = " ";
            if($i==count($timings_keys)-1){
                foreach($timings_values[$i] as $value){
                    if(count($value)){
                        foreach($value as $value1){
                            $temp_display_time .= date("h:i A" , strtotime($value1))." - ";
                        }

                        $temp_display_time = trim($temp_display_time, " - ");
                    }

                    $temp_display_time .= " , ";
                }

                $temp_display_time = $timings_keys[$i]." ".trim( $temp_display_time, " , ")." ; " ;


                $display_timings =  $display_timings.$temp_display_time ;

            }

            // echo $temp_display_time;

            for($j=$i+1 ;  $j < count($timings_keys) ; $j++){

                // if this is the first loop and it goes till and it has 7 days timings then show "Open daily Text"

                if($i==0 && $j == 6 && json_encode($timings_values[$i]) == json_encode($timings_values[$j])){

                    foreach($timings_values[$i] as $value){
                        if(count($value)==2){
                            foreach($value as $value1){
                                $display_timings .= date("h:i A" , strtotime($value1))." - ";
                            }

                            $display_timings = trim($display_timings," - ").' , ';
                        }

                    }
                    return "Open Daily ".trim($display_timings , " , ");
                }
                // converting the each timings in json string and comparing to next element in loop
                if(json_encode($timings_values[$i]) == json_encode($timings_values[$j])){

                    // if second last value is same with the next

                    if($j == count($timings_values)-1){
                        foreach($timings_values[$j-1] as $value){
                            if(count($value)){
                                foreach($value as $value1){
                                    $temp_display_time .= date("h:i A" , strtotime($value1))." - ";
                                }

                                $temp_display_time = trim($temp_display_time, " - ");
                            }

                            $temp_display_time .= " , ";

                            if(  $timings_keys[$i] ==  $timings_keys[$j]){
                                $temp_display_time = $timings_keys[$i]." ".$temp_display_time ;
                            }else{
                                $temp_display_time = $timings_keys[$i]."-".$timings_keys[$j]." ".$temp_display_time ;
                            }


                            return  $display_timings.trim($temp_display_time , " , ")." ; ";

                            // increasing the pointer for $i
                            if($j<count($timings_keys)){
                                $i = $j-1;
                            }
                        }

                    }

                    continue;
                }else{

                    // if it is not matched

                    // checking the timings of last matched value

                    foreach($timings_values[$j-1] as $value){
                        if(count($value)){
                            foreach($value as $value1){
                                $temp_display_time .= date("h:i A" , strtotime($value1))." - ";
                            }

                            $temp_display_time = trim($temp_display_time, " - ");
                        }

                        $temp_display_time .= " , ";
                    }
                    $temp_display_time = trim($temp_display_time, " , ");
                    if($i == $j-1 && $i != count($timings_keys)-1){
                        $temp_display_time = $timings_keys[$i]." ".$temp_display_time." ; " ;
                    }elseif($i == $j-1 && $i == count($timings_keys)-1){
                        $temp_display_time = $timings_keys[$i]." ".$temp_display_time." ; " ;
                    }else{
                        $temp_display_time = $timings_keys[$i]."-".$timings_keys[$j-1]." ".trim($temp_display_time , " , ")." ; " ;
                    }

                    $display_timings = $display_timings.$temp_display_time;

                    if($i<count($timings_keys)){

                        $i = $j-1;
                    }

                    continue 2;
                }
            }
        }
        return trim($display_timings, " , ");

    }


    function getTimingsByShortKeys($timings){
        $new_timings = [];
        foreach($timings as $key=>$value ){
            if($key=='monday'){
                $new_timings['Mon'] = $value;
            }elseif($key=='tuesday'){
                $new_timings['Tue'] = $value;
            }elseif($key=='wednesday'){
                $new_timings['Wed'] = $value;
            }elseif($key=='thursday'){
                $new_timings['Thu'] = $value;
            }elseif($key=='friday'){
                $new_timings['Fri'] = $value;
            }elseif($key=='saturday'){
                $new_timings['Sat'] = $value;
            }elseif($key=='sunday'){
                $new_timings['Sun'] = $value;
            }
        }

        return $new_timings;
    }

    function yelpScrapTimingsToFactualTimings($yelp_working_hours){

        $working_hours = NULL;

        foreach($yelp_working_hours as $key=>$value){
            if(strlen(trim($value["hours"]))==0){
                unset($value['day']);
                continue;
            }
            $times = null;
            if(strpos($value['hours'], ",")){
                $times = explode(",", $value['hours']);
                $value['hours']=[];
                $hr = [];
                for($i=0; $i < count($times); $i++){
                    $hours = explode("-", $times[$i]);
                    $hr[$i][0]  = date("H:i", strtotime($hours[0]));
                    $hr[$i][1]  = date("H:i", strtotime($hours[1]));
                }
                $value['hours'] = $hr;
            }else{
                $value['hours'] = explode("-", $value['hours']);
                $value['hours'][0]  = date("H:i", strtotime($value['hours'][0]));
                $value['hours'][1]  = date("H:i", strtotime($value['hours'][1]));
            }

            if($value['day']== 'Mon')
                $working_hours["monday"] = isset($times) ? $value["hours"] : [$value["hours"]];
            if($value['day']== 'Tue')
                $working_hours["tuesday"] =  isset($times) ? $value["hours"] : [$value["hours"]];
            if($value['day']== 'Wed')
                $working_hours["wednesday"] =  isset($times) ? $value["hours"] : [$value["hours"]];
            if($value['day']== 'Thu')
                $working_hours["thursday"] = isset($times) ? $value["hours"] : [$value["hours"]];
            if($value['day']== 'Fri')
                $working_hours["friday" ] =  isset($times) ? $value["hours"] : [$value["hours"]];
            if($value['day']== 'Sat')
                $working_hours["saturday"] =  isset($times) ? $value["hours"] : [$value["hours"]];
            if($value['day']== 'Sun')
                $working_hours["sunday" ] =  isset($times) ? $value["hours"] : [$value["hours"]];
            $scrapperData['working_hours'] = [];
        }
        return $working_hours;
    }

}
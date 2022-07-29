<?php 
require_once "config.php";
include_once "createTable.php";
$time = ['8:00-10:00','10:00-12:00','12:00-2:00','2:00-4:00'];
$time_i = 0;
$teacherTable = [];
$teacherNum = 0;
$lab_i = 0;
while ($lab_i != $numOfLabs){
    for ($i = 0; $i < count($days); $i++)
    {
        $timeNum = 0;
        for ($j = 0; $j < $hours; $j+=2){
            // if (!($labs[$lab_i]['courses'][$i][$j]['code_course'] == 'N/A')) {
                if ($pos = courseExists($teacherTable,$labs[$lab_i]['courses'][$i][$j]['code_course'])) {
                    $teacherTable[$pos]['classRoom'][1] = $labs[$lab_i]['name'];
                    $teacherTable[$pos]['time'][1] = $time[$timeNum++];
                    $teacherTable[$pos]['days'][1] = $days[$i];
                } else{
                    $teacherTable[$teacherNum++] = [
                        "code_course"=>$labs[$lab_i]['courses'][$i][$j]['code_course'],
                        "teacher"=>$labs[$lab_i]['courses'][$i][$j]['teacher'],
                        "classRoom"=>[0=>$labs[$lab_i]['name']],
                        "time"=>[0=>$time[$timeNum++]],
                        "days"=>[0=>$days[$i]]
                    ];
                }

            // }
        }
    }
    $lab_i++;
}

// for ($i=0; $i < count($teacherTable); $i++) { 
//     if (!($teacherTable[$i]['code_course']==='N/A')) {
   
//         echo "[". $teacherTable[$i]['code_course'] ."] - ";
//         echo "[". $teacherTable[$i]['teacher'] ."] - ";

//         for ($j=0; $j < count($teacherTable[$i]['days']); $j++) { 
//             echo "[". $teacherTable[$i]['days'][$j] ."] - ";
//         }
//         for ($j=0; $j < count($teacherTable[$i]['classRoom'] ); $j++) { 
//             echo "[". $teacherTable[$i]['classRoom'][$j] ."] - ";
//         }
//         for ($j=0; $j < count($teacherTable[$i]['time'] ); $j++) { 
//             echo "[". $teacherTable[$i]['time'][$j] ."]- ";
//         }
//         echo '<br>';
//     }
// }


function courseExists($tb,$val){
    for ($i=0; $i < count($tb); $i++) { 
        if ($tb[$i]['code_course'] == $val) {
            return $i;
        }
    }
    
    return false;
}
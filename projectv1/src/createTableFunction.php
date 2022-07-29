<?php
function allHours($courses)
{
    $x = 0;
    for ($i = 0; $i < count($courses); $i++)
    {
        $x += $courses[$i]['hours'];
    }
    return $x;
}

function allLevels($courses, $level){
    $x = $j = 0;
    for ($i = 0; $i < count($courses); $i++)
    {
        if ($courses[$i]['lvl'] == $level)
        {
            $x++;
            $j += $courses[$i]['hours'];
        }
    }
    return $j;
}
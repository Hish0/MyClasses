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
$sn = "localhost";
$un = "root";
$pw = "";
$nameDB = "timelecture";
$conn = new mysqli($sn, $un, $pw, $nameDB);
$all_course=[];
$labs=[];
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT code_course,tec_id FROM  tec_course ORDER BY code_course";
$resulte_course_teacher = $conn->query($sql);
if ($resulte_course_teacher->num_rows > 0) {
  for ($i=0; $i < $resulte_course_teacher->num_rows ; $i++) { 
    $teacher_courses = $resulte_course_teacher->fetch_assoc();

    $tec_id = $teacher_courses['tec_id']; 
    $sql = "SELECT tec_name FROM teacher WHERE tec_id = '$tec_id'";
    $resulte_teacher = $conn->query($sql);
    $tec_name = $resulte_teacher->fetch_assoc()['tec_name'];

    $code_course = $teacher_courses['code_course'];
    $sql = "SELECT lvl,c_hourse FROM courses WHERE code_course = '$code_course'";
    $resulte_courses = $conn->query($sql);
    $course_info = $resulte_courses->fetch_assoc();
    $all_course[$i] = [
        'id'=>$i+1,
        'code_course'=>$teacher_courses['code_course'],
        'lvl'=>$course_info['lvl'],
        'hours'=>$course_info['c_hourse'],
        'teacher'=>$tec_name
    ];

  }
}

$sql = "SELECT cr_id,cr_capacity FROM  classrooms";
$resulte_classroom = $conn->query($sql);
if ($resulte_classroom->num_rows > 0) {
    for ($i=0; $i <$resulte_classroom->num_rows ; $i++) { 
        $classroom = $resulte_classroom->fetch_assoc();
        $labs[$i]=[
            'id'=>$i+1,
            'name'=>$classroom['cr_id'],
            'capacity'=>$classroom['cr_capacity'],
            'courses'=>[]
        ];
    }
    
}
$conn->close();

// echo "<pre>";
// print_r($all_course);
// echo "</pre>";
// echo "<pre>";
// print_r($labs);
// echo "</pre>";

// $a=[];
// $a[0][1][0]=$all_course[0];
// echo $a[0][1][0]['name'];
$days = 6; 
$hours = 8; 
$levels = 4; 
$numOfLabs = count($labs);

$def = ['lvl'=>0,'code_course'=>'N/A'];

$lab_i = 0;
while ($lab_i != $numOfLabs)
{
    $n = 0;
    $k = 1;
    for ($i = 0; $i < $days; $i++)
    {
        for ($j = 0; $j < $hours; $j += 2)
        {
            if ($n == count($all_course))
            {
                $n = 0;
            }
            if ($k != ($levels + 1))
            {
               
                if (allHours($all_course) == 0)
                {
                    break;
                }
                else if ($all_course[$n]['lvl'] == $k && $all_course[$n]['hours'] != 0)
                {
                    $labs[$lab_i]['courses'][$i][$j] = $all_course[$n];
                    $labs[$lab_i]['courses'][$i][$j + 1] = $all_course[$n];

                    $all_course[$n]['hours']-=2;
                    $k++;
                    $n++;
                }
                else if (allLevels($all_course, $k) == 0)
                {
                    $k++;
                    $n++;
                    $def['lvl'] = $k;

                    $labs[$lab_i]['courses'][$i][$j] = $def;
                    $labs[$lab_i]['courses'][$i][$j + 1] = $def;
                }
                else
                {
                    $n++;
                    $j -= 2;
                }
            }
            else
            {
                $k = 1;
                $j -= 2;
            }
        }
        $k = $labs[$lab_i]['courses'][$i][0]['lvl'];
        $k++;
    }
    $lab_i++;
}
// output
// $lab_i = 0;
// while ($lab_i != $numOfLabs)
// {
//     echo "<br> lab number  ". $lab_i+1 ."<br>";
//     for ($i = 0; $i < $days; $i++)
//     {
//         for ($j = 0; $j < $hours; $j++)
//         {
//             echo $labs[$lab_i]['courses'][$i][$j]['code_course'] . "-";
//         }
//         echo "<br>";
//     }
//     $lab_i++;
// }

// // return 0;
?>
<!DOCTYPE html>
<html>
  <style>
    table,
    th,
    td {
      border: 1px solid black;
    }
  </style>
  <body>
    <div class="time-table">
    <?php
    $lab_i = 0;
    while ($lab_i != $numOfLabs){
    ?>  
    <h2>lab <?php echo $lab_i+1 ?></h2>
    <table style="width: 100%">

      <tr>
        <td>Days\Time</td>
        <td>8:00-9:00</td>
        <td>9:00-10:00</td>
        <td>10:00-11:00</td>
        <td>11:00-12:00</td>
        <td>12:00-1:00</td>
        <td>1:00-2:00</td>
        <td>2:00-3:00</td>
        <td>3:00-4:00</td>
       
      </tr>
        <?php
        for ($i = 0; $i < $days; $i++)
        {
        ?>
        <tr>
        <td><?php echo $i+1 ?></td>

        <?php
          for ($j = 0; $j < $hours; $j++){
            ?>
            <td><?php echo $labs[$lab_i]['courses'][$i][$j]['code_course']?></td>
            <?php
          }
          ?>
        </tr>
        <?php
        }
        ?>
           
    </table>
    <?php
         $lab_i++;

    }
    ?>
    </div>
  </body>
</html>

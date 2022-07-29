<?php
require_once "config.php";

include_once "createTableFunction.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$all_course=[];
$labs=[];
$conn = new mysqli($sn, $un, $pw, $nameDB);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else{ 
  $conn->begin_transaction();
  try {
      $sql = "SELECT code_course,tec_id FROM  tec_course ORDER BY code_course";
      $resulte_course_teacher = $conn->query($sql);//للحصول على رمز المقرر ورقم المدرس من جدول مقررات المدرسين 
      if ($resulte_course_teacher->num_rows > 0) {
        for ($i=0; $i < $resulte_course_teacher->num_rows ; $i++) { //جملة التكرار هذه لكي تقوم بلف على ارقام المدرسين كلهم وتخزين معلومات المواد الكلهم الخاصة بهم في مصفوفة الكورسات
          $teacher_courses = $resulte_course_teacher->fetch_assoc();
          $tec_id = $teacher_courses['tec_id']; 
          $sql = "SELECT tec_name FROM teacher WHERE tec_id = '$tec_id'";//جملة استعلام عن الاسم الخاص بكل رقم مدرس
          $resulte_teacher = $conn->query($sql);
          if ($resulte_teacher->num_rows > 0) {
            $tec_name = $resulte_teacher->fetch_assoc()['tec_name'];//تخزين اسم المدرس في متغير
          }

          $code_course = $teacher_courses['code_course'];//تخزين رمز المقرر الخاص بالمدرس في متغير
          $sql = "SELECT lvl,c_hourse FROM courses WHERE code_course = '$code_course'";//جملة استعلام عن مستوى المقرر وعدد ساعاته
          $resulte_courses = $conn->query($sql);
          $course_info = $resulte_courses->fetch_assoc();//تخزين معلومات الكورس في مصفوفة 
          $all_course[$i] = [ //مصفوفة بيانات المقررات 
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
      $conn->commit();
  } catch(mysqli_sql_exception $exception){
    echo 'Transaction Failed!!';
    $conn->rollback();
    $conn=null;
    echo'<br>';
    echo $exception->getMessage();
  }
}
$conn->close();

$days = ['Saturday','Sunday','Monday','Tuesday','Wenesday','Thursday'];
$hours = 8; 
$levels = 4; 
$numOfLabs = count($labs);

$def = ['lvl'=>0,'code_course'=>'N/A','teacher'=>'N/A'];

$lab_i = 0;
while ($lab_i != $numOfLabs) {
  $n = 0;
  $k = 1;
  for ($i = 0; $i < count($days); $i++) {
    for ($j = 0; $j < $hours; $j += 2) {
        if ($n == count($all_course)) {
          $n = 0;
        }
        if ($k != ($levels + 1)) {
          if (allHours($all_course) == 0) {
            break;
          } else if ($all_course[$n]['lvl'] == $k && $all_course[$n]['hours'] != 0) {
            $labs[$lab_i]['courses'][$i][$j] = $all_course[$n];
            $labs[$lab_i]['courses'][$i][$j + 1] = $all_course[$n];

            $all_course[$n]['hours']-=2;
            $k++;
            $n++;
          } else if (allLevels($all_course, $k) == 0) {
            $k++;
            $n++;
            $def['lvl'] = $k;

            $labs[$lab_i]['courses'][$i][$j] = $def;
            $labs[$lab_i]['courses'][$i][$j + 1] = $def;
          } else {
            $n++;
            $j -= 2;
          }
        } else
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

<?php
//  require_once "config.php";
$code_courses=[];
$courses=[];
$person=[];
if (isset($_GET['id'])) {
    $showCardCourses = '';
    $id=$_GET['id'];
    $nameColumId= $_GET['nameColumId'];
    $nameColumName= $_GET['nameColumName'];
    $tblCourse = $_GET['tblCourse'];
    $tblPerson = $_GET['tblPerson'];
   
    $conn = new mysqli($sn, $un, $pw, $nameDB);
   
    if ($conn->connect_error){ 
        die("Connection failed: " . $conn->connect_error);
    }
    $sqlPerson = "SELECT $nameColumName FROM $tblPerson WHERE $nameColumId = $id";
    $resultPerson = $conn->query($sqlPerson);

    if ($resultPerson->num_rows > 0) {
        $person = ['id' => $id,'name'=>$resultPerson->fetch_assoc()[$nameColumName]];
        $sqlCodeCourses = "SELECT code_course FROM $tblCourse WHERE $nameColumId = $id";
        $resultCourseCode = $conn->query($sqlCodeCourses);
        if ($resultCourseCode->num_rows > 0) {
        
            //get courses for the person
            for ($i=0 ; $i < $resultCourseCode->num_rows ; $i++){
                $code_courses[$i] = $resultCourseCode->fetch_assoc();
            }
            //get courses name for person
            for ($i=0; $i <  $resultCourseCode->num_rows; $i++) { 
                $courseCode = $code_courses[$i]['code_course'];

                $sqlCourseName = "SELECT course_name FROM courses WHERE code_course = '$courseCode'";
                $resultCourseName = $conn->query($sqlCourseName);

                if ($resultCourseName->num_rows > 0) {
                    $courses[$i] = ['course_code' => $code_courses[$i]['code_course'],'course_name' => $resultCourseName->fetch_assoc()['course_name']];
                }else{
                    break;
                }
            }
        }
    }

}



<?php

// require_once "config.php";
//submit التحقق من طلب الارسال عن طريق فحص قيمة
if (isset($_POST['submit'])) {
    //المتغيرات الخاصة ببيانات المقرر
    $ccode = trim($_POST['ccode']);
    $cname = trim($_POST['cname']);
    $lvl = trim($_POST['lvl']);
    $cprequist = trim($_POST['cprequist']);
    $cthours = trim($_POST['cthours']);
    $cwhours = trim($_POST['cwhours']);
    //جملة الاتصال
    $conn = new mysqli($sn, $un, $pw, $nameDB);
    // التحقق من الاتصال اذا فشل او لا
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //اذا نجح الاتصال
    else{

       if (strtolower($_POST['submit']) === 'add') {
            //جملة اضافة بيانات المقرر
            $course_query = "INSERT INTO courses (code_course,course_name,lvl,prequist, c_hourse,l_hourse)
                                VALUES ('$ccode','$cname','$lvl','$cprequist','$cthours','$cwhours')";

            //تحقق اذا تم تنفيذ جملة الاستعلام الخاصة بأضافة الطالب
            if ($conn->query($course_query) === TRUE) {

            } else {
                echo "Error: " . $course_query . "<br>" . $conn->error;
            }
        }
        
        if (strtolower($_POST['submit']) === 'edit') {
            //جملة اضافة بيانات المقرر
            $editCourse_query = "UPDATE courses 
                            SET course_name='$cname',lvl='$lvl',prequist='$cprequist',c_hourse='$cthours',l_hourse='$cwhours'
                            WHERE code_course='$ccode'";
            //تحقق اذا تم تنفيذ جملة الاستعلام الخاصة بأضافة الطالب
            if ($conn->query($editCourse_query) === TRUE) {

            } else {
                echo "Error: " . $editCourse_query . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();//اغلاق الاتصال

}   
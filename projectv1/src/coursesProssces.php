<?php

require_once "config.php";
//submit التحقق من طلب الارسال عن طريق فحص قيمة
if (isset($_POST['submit'])) {
    //المتغيرات الخاصة ببيانات المقرر
    $ccode = trim($_POST['ccode']);
    $cname = trim($_POST['cname']);
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
        //جملة اضافة بيانات المقرر
        $course_query = "INSERT INTO courses (code_course,course_name,prequist, t_hourse,w_hourse)
                         VALUES ('$ccode','$cname','$cprequist','$cthours','$cwhours')";

        //تحقق اذا تم تنفيذ جملة الاستعلام الخاصة بأضافة الطالب
        if ($conn->query($course_query) === TRUE) {
            echo "New course record created successfully<br>";
        } else {
            echo "Error: " . $course_query . "<br>" . $conn->error;
        }
    }

    $conn->close();//اغلاق الاتصال

} else{
    echo"try again";
}

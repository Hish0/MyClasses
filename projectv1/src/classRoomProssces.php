<?php

//submit التحقق من طلب الارسال عن طريق فحص قيمة
if (isset($_POST['submit'])) {
    //المتغيرات الخاصة ببيانات المقرر
    $cr_num = trim($_POST['cr_num']);
    $cr_capy = trim($_POST['cr_capacity']);
    $cr_loc = trim($_POST['cr_location']);
    $cr_dep = trim($_POST['cr_department']);
    $cr_type = trim($_POST['cr_type']);
    //جملة الاتصال
    $conn = new mysqli($sn, $un, $pw, $nameDB);
    // التحقق من الاتصال اذا فشل او لا
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //اذا نجح الاتصال
    else{

       if (strtolower($_POST['submit']) === 'add') {
            //جملة اضافة بيانات القعاة
            $classroom_query = "INSERT INTO classrooms (cr_id,cr_capacity,cr_location, cr_dep,cr_type)
                                VALUES ('$cr_num','$cr_capy','$cr_loc','$cr_dep','$cr_type')";
            //تحقق اذا تم تنفيذ جملة الاستعلام الخاصة بأضافة قاعة
            if ($conn->query($classroom_query) === TRUE) {
            } else {
                echo "Error: " . $classroom_query . "<br>" . $conn->error;
            }
        }

        if (strtolower($_POST['submit']) === 'edit') {
            //جملة اضافة بيانات المقرر
            $editClaasroom_query = "UPDATE classrooms 
                                SET cr_capacity='$cr_capy',cr_location='$cr_loc',cr_dep='$cr_dep',cr_type='$cr_type'
                                WHERE cr_id='$cr_num'";
            //تحقق اذا تم تنفيذ جملة الاستعلام الخاصة بأضافة قاعة
            if ($conn->query($editClaasroom_query) === TRUE) {
            
            } else {
                echo "Error: " . $editClaasroom_query . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();//اغلاق الاتصال

}   
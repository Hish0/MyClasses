<?php
    // require_once "config.php";
    //submit التحقق من طلب الارسال عن طريق فحص قيمة
    if (isset($_POST['submit'])) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        //المتغيرات الخاصة ببيانات الطالب
        $fullname = trim($_POST['fname'])." ".trim($_POST['mname'])." ".trim($_POST['lname']);
        $tec_id = trim($_POST['tec_id']);
        $acde = trim($_POST['acde']);
        $edu_degree = trim($_POST['edu_degree']);
        //مصفوفة المقررات الخاصة بالاستاذ
        $courses = $_POST['courses'];
        //جملة الاتصال
        $conn = new mysqli($sn, $un, $pw, $nameDB);
        // التحقق من الاتصال اذا فشل او لا
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else{
            $conn->begin_transaction();
            try {
                //اذا كان طلب التقديم اضافة بيانات
                if (strtolower($_POST['submit']) === 'add') {
                    //اذا نجح الاتصال
                    //جملة اضافة بيانات الطالب
                    $tec_query = "INSERT INTO teacher (tec_id,tec_name,aca_deg,edu_deg)
                                    VALUES ('$tec_id','$fullname','$acde','$edu_degree')";
                    //تحقق اذا تم تنفيذ جملة الاستعلام الخاصة بأضافة الطالب
                    if ($conn->query($tec_query) === TRUE) {
                        // echo "New teacher record created successfully<br>";
                        //بعد التحقق سيتم اضافة المقررات التي انجزها الطالب وتم اختايرها عن طريق النظام
                        //سيتم اضافة المقررات على كل واحدة لوحدها بواسطة جملة التكرار
                        insertCourses($courses,$tec_id,$conn);       
                    } else {
                        echo "Error: " . $tec_query . "<br>" . $conn->error;
                    }
                }
                //اذا كان طلب التقديم تعديل بيانات
                if (strtolower($_POST['submit']) === 'edit') {
                    $editTec_query = "UPDATE teacher 
                                    SET tec_name='$fullname',aca_deg='$acde',edu_deg='$edu_degree' 
                                    WHERE tec_id='$tec_id'";
                    if ($conn->query($editTec_query) === TRUE) {
                        
                        $delCourse_query = "DELETE FROM tec_course WHERE tec_id = '$tec_id'";
                        
                        if ($conn->query($delCourse_query) === TRUE) {
                            insertCourses($courses,$tec_id,$conn);
                        } else {
                            echo "Error: " . $delCourse_query . "<br>" . $conn->error;
                        }
                    } else {
                        echo "Error: " . $editTec_query . "<br>" . $conn->error;
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

        $conn->close();//اغلاق الاتصال

    }

function insertCourses($courses,$tec_id,$conn)
{
    for ($i = 0 ; $i < count($courses) ; $i++) {
        //جملة استعلام الخاصة بأضافة المقرارات 
        $course_query = "INSERT INTO tec_course (tec_id,code_course,course_hours)
                        VALUES ('$tec_id','$courses[$i]','4')";
        //التحقق من اذا تم اضافة كل مقرر تم اختايره الى قاعدة البيانات
        if ($conn->query($course_query) === TRUE) {
            // echo "New week hours course record add successfully<br>";
        } else {
            echo "Error: " .  $course_query  . "<br>" . $conn->error;
        }
    }
    //سيتم الان جمع ساعات الطالب التي انجزها عن طريق جملة استعلام لحساب الساعات من جدول المقررات المنجزة الاستاذ
    $resulte = $conn->query("SELECT SUM(course_hours) 
                            AS totalsum 
                            FROM tec_course 
                            WHERE tec_id = '$tec_id'");
    //التحقق ما اذا تم جلب مجموع الساعات عن طريق معرفة هل الصفوف المرجعة من جملة الاستعلام اكبر من صفر
    if ($resulte->num_rows > 0) {
        //تحزين النتيجة في مصفوفة ذات مفتاح نصي
        $row = $resulte->fetch_assoc();
        // جلب النتيجة من المصفوفة عن طريق المفتاح النصي الذي تم استخدامه في جملة الستعلام الخاصة بمجموع الساعات
        $week_houers = $row['totalsum'];//AS totalsum
        //عمل تحديث للحقل الخاص بعدد المواد المنجزة في جدول الطالب واضافة عدد الساعات المنجزة اليه
        $complete_course_hours = "UPDATE teacher SET week_hours  = '$week_houers' WHERE tec_id = '$tec_id'";
        
        //التحقق اذا انتهت اضافة عدد الساعات المنجزة بنجاح
        if ($conn->query($complete_course_hours) === TRUE) {
            // echo "number of courses houer updated successfully<br>";
        } else {
            echo "Error: " . $complete_course_hours . "<br>" . $conn->error;
        }

    }  else {
        echo "Error: " . $resulte . "<br>" . $conn->error;
    }
}
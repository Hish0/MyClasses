<?php
    require_once "config.php";
    //submit التحقق من طلب الارسال عن طريق فحص قيمة
    if (isset($_POST['submit'])) {
        //المتغيرات الخاصة ببيانات الطالب
        $fullname = trim($_POST['fname'])." ".trim($_POST['mname'])." ".trim($_POST['lname']);
        $stu_id = trim($_POST['stu_id']);
        $phone = trim($_POST['phone']);
        $colloge = trim($_POST['colloge']);
        $dep = trim($_POST['dep']);
        //مصفوفة المقررات المنجزة
        $courses = $_POST['courses'];
        //جملة الاتصال
        $conn = new mysqli($sn, $un, $pw, $nameDB);
        // التحقق من الاتصال اذا فشل او لا
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //اذا نجح الاتصال
        else{
            //جملة اضافة بيانات الطالب
            $student_query = "INSERT INTO students (stu_id,stu_name,stu_phone, stu_colloge,stu_dep)
                             VALUES ('$stu_id','$fullname','$phone','$colloge','$dep')";
            //تحقق اذا تم تنفيذ جملة الاستعلام الخاصة بأضافة الطالب
            if ($conn->query($student_query) === TRUE) {
                echo "New student record created successfully<br>";
               
                //بعد التحقق سيتم اضافة المقررات التي انجزها الطالب وتم اختايرها عن طريق النظام
                //سيتم اضافة المقررات على كل واحدة لوحدها بواسطة حملة التكرار
                for ($i = 0 ; $i < count($courses) ; $i++) {
                    //جملة استعلام الخاصة بأضافة المقرارات 
                    $course_query = "INSERT INTO completed_courses (stu_id,code_course,course_hourse)
                                     VALUES ('$stu_id','$courses[$i]','4')";
                    
                    //التحقق من اذا تم اضافة كل مقرر تم اختايره الى قاعدة البيانات
                    if ($conn->query($course_query) === TRUE) {
                        echo "New completed course record add successfully<br>";
                    } else {
                        echo "Error: " .  $course_query  . "<br>" . $conn->error;
                    }

                }
                //سيتم الان جمع ساعات الطالب التي انجزها عن طريق جملة استعلام لحساب الساعات من جدول المقررات المنجزة الخاص بالطالب
                $resulte = $conn->query("SELECT SUM(course_hourse) AS totalsum FROM completed_courses WHERE stu_id = '$stu_id'");
                
                //التحقق ما اذا تم جلب مجموع الساعات عن طريق معرفة هل الصفوف المرجعة من جملة الاستعلام اكبر من صفر
                if ($resulte->num_rows > 0) {
                    //تحزين النتيجة في مصفوفة ذات مفتاح نصي
                    $row = $resulte->fetch_assoc();
                    // جلب النتيجة من المصفوفة عن طريق المفتاح النصي الذي تم استخدامه في جملة الستعلام الخاصة بمجموع الساعات
                    $courses_hours = $row['totalsum'];//AS totalsum
                    //عمل تحديث للحقل الخاص بعدد المواد المنجزة في جدول الطالب واضافة عدد الساعات المنجزة اليه
                    $complete_course_hours = "UPDATE students SET num_completed_hourse = '$courses_hours' WHERE stu_id = '$stu_id'";
                    
                    //التحقق اذا انتهت اضافة عدد الساعات المنجزة بنجاح
                    if ($conn->query($complete_course_hours) === TRUE) {
                        echo "number of courses houer updated successfully<br>";
                    } else {
                        echo "Error: " . $complete_course_hours . "<br>" . $conn->error;
                    }

                }  else {
                    echo "Error: " . $resulte . "<br>" . $conn->error;
                }              
    
            } else {
                echo "Error: " . $student_query . "<br>" . $conn->error;
            }
        }

        $conn->close();//اغلاق الاتصال

    } else{
        echo"try again";
    }

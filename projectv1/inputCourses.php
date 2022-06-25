<?php
    // require_once "src/config.php";
    // $conn = new mysqli($sn, $un, $pw, $nameDB);
    // $data = [];
    // if ($conn->connect_error) {
    //   echo"feild connction";
    // }
    // else {
    //   $sql = "SELECT code_course,course_name FROM courses";
    //   $result = $conn->query($sql);
    //   if ($result->num_rows > 0) {
    //     // output data of each row
    //     for ($i=0; $i < $result->num_rows; $i++) { 
    //       $data[$i] = $result->fetch_assoc();
    //     }
    //   } else {
    //     echo "0 results";
    //   }
    // }
    // $conn->close();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>courses</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
  <div class="header">
  <a href="displayStudent.php">Student</a>
    <a href="displayTeacher.php">Teacher</a>
    <a href="displayCourses.php">Courses</a></div>
    <div class="containor">
      <div class="courses-inputs">
        <form action="src/coursesProssces.php" method="post">
          <h2>Courses INFO</h2>
          <!-- <div class="name-inputs in-el-size"> -->
            <input type="text" name="ccode" placeholder="Course Code" required/>
            <input type="text" name="cname" placeholder="Course Name" required/>
            <input type="text" name="cprequist" placeholder="Prequist" required/>
          <!-- </div> -->
          <!-- <div class="unvirsty-inputs in-el-size"> -->
            <input type="text" name="cthours" placeholder="theoretic Hours" required/>
            <input type="text" name="cwhours" placeholder="Working Hours" required/>

          <!-- </div> -->
          <div>
            <p id="emptyInput" class="msgWarning" hidden>
              *Some of the required fields are empty, please fill them
            </p>
          </div>
          <div class="btns">
            <button name="submit" value="submit" class="btn">ADD</button>
            <button type="button" class="btn"><a href="displayCourse.php"> Show Courses</a></button>
          </div>
        </form>
      </div>
    </div>
    <script src=""></script>
  </body>
</html>

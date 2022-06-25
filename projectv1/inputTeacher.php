<?php
    require_once "src/config.php";
    $conn = new mysqli($sn, $un, $pw, $nameDB);
    $data = [];
    if ($conn->connect_error) {
      echo"feild connction";
    }
    else {
      $sql = "SELECT code_course,course_name FROM courses";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
        for ($i=0; $i < $result->num_rows; $i++) { 
          $data[$i] = $result->fetch_assoc();
        }
      } else {
        echo "0 results";
      }
    }
    $conn->close();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
  <div class="header">
  <a href="displayStudent.php">Student</a>
    <a href="displayTeacher.php">Teacher</a>
    <a href="displayCourses.php">Courses</a></div>
    <div class="containor">
      <div class="student-inputs">
        <form action="src/teacherProssces.php" method="post">
          <h2>Teacher INFO</h2>
          <!-- <div class="name-inputs in-el-size"> -->
            <input type="text" name="fname" placeholder="First Name" required/>
            <input type="text" name="mname" placeholder="Middle Name" required/>
            <input type="text" name="lname" placeholder="Last Name" required/>
          <!-- </div> -->
          <!-- <div class="unvirsty-inputs in-el-size"> -->
            <input type="text" name="tec_id" placeholder="teacher ID" required/>
            <input type="text" name="acde" placeholder="acadmic degree" required/>
            <input type="text" name="edu_degree" placeholder="edu degree" required/>
          <!-- </div> -->
          <select name="courses[]" id="course" multiple required>
            <?php for ($i=0; $i < count($data); $i++) { ?>
                <option value="<?php echo $data[$i]['code_course'] ?>"><?php echo $data[$i]['course_name'] ?></option>
            <?php
            }
            ?>
            </select>
          <div>
            <p id="emptyInput" class="msgWarning" hidden>
              *Some of the required fields are empty, please fill them
            </p>
          </div>
          <div class="btns">
            <button name="submit" value="submit" class="btn">ADD</button>
            <button type="button" class="btn"><a href="displayTeacher.php"> Show Teacher</a></button>
          </div>
        </form>
      </div>
    </div>
    <script src=""></script>
  </body>
</html>

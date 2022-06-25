<?php
    require_once "src/config.php";

    $conn = new mysqli($sn, $un, $pw, $nameDB);
    $courses=[];
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM Courses";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
     for ($i=0 ; $i < $result->num_rows ; $i++){
       $courses[$i] = $result->fetch_assoc(); 
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
    <title>students show</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
  <div class="header">
  <a href="displayStudent.php">Student</a>
    <a href="displayTeacher.php">Teacher</a>
    <a href="displayCourses.php">Courses</a></div>
    <div class="containor">
      <h1 class="stu-show-title">show courses info</h1>
      <div class="table-wrap">
      <table class="student-table" id="stu-table">
        <thead>
          <tr>
            <th>Course Code</th>
            <th>Course Name</th>
            <th>Course Prequist</th>
            <th>Theoretic Hours</th>
            <th>Working Hours</th>
            <th>Edit/Delete/Show</th>
          </tr>
        </thead>
        <tbody>
          <?php for ($i=0; $i < count($courses); $i++) { 
          ?>
           <!-- code_course,course_name,prequist, t_hourse,w_hourse-->
            <tr>
              <td><?php echo $courses[$i]['code_course'] ?></td>
              <td><?php echo $courses[$i]['course_name'] ?></td>
              <td><?php echo $courses[$i]['prequist'] ?></td>
              <td><?php echo $courses[$i]['t_hourse'] ?></td>
              <td><?php echo $courses[$i]['w_hourse'] ?></td>
              <td>
              <a href="src/deleteRecord.php?id=<?php echo $courses[$i]['code_course']; ?>&tbname=courses&key=code_course&loc=displayCourses.php"
               onclick="return confirm('Are you sure?')">Delete</a>
            </td>
            </tr>
            <?php
          }?>
        </tbody>
      </table>
      </div>
      <div class="btns-student-table">
      <a class="btn-link" href="inputCourses.php">ADD Courses</a>
      </div>
    </div>
    <script>

  </body>
</html>
<a href="edit.php?del=d&mid=<?php echo $students[$i]['stu_id'] ?>" onclick="return del();" ><img border="0" src="images/icon_delete.png" /></a>
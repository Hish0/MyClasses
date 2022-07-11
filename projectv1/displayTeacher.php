<?php
  include_once "src/session.php";
  require_once "src/config.php";
  $conn = new mysqli($sn, $un, $pw, $nameDB);
  $teacher=[];
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM teacher";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    for ($i=0 ; $i < $result->num_rows ; $i++){
      $teacher[$i] = $result->fetch_assoc(); 
    }
  }
  $conn->close();
  $showCardCourses = 'none';
  require_once "src/dataCard.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>teacher show</title>
    <link rel="stylesheet" href="css/style.css"/>

  </head>
  <body>
    <div class="containor">
  <?php include "main/header.php"; ?>
      <h1 class="stu-show-title">show teacher info</h1>
      <div class="table-wrap">
      <table class="student-table" id="stu-table">
        <thead>
          <tr>
            <th>teacher ID</th>
            <th>teacher Name</th>
            <th>week Hours</th>
            <th>acdamic degree</th>
            <th>edu degree</th>
            <th>Courses</th>
            <th>Delete/Edit</th>
          </tr>
        </thead>
        <tbody>
          <?php for ($i=0; $i < count($teacher); $i++) { 
          ?>
            <tr>
              <td><?php echo $teacher[$i]['tec_id'] ?></td>
              <td><?php echo $teacher[$i]['tec_name'] ?></td>
              <td><?php echo $teacher[$i]['week_hours'] ?></td>
              <td><?php echo $teacher[$i]['aca_deg'] ?></td>
              <td><?php echo $teacher[$i]['edu_deg'] ?></td>
              <td>
                <a href="?id=<?php echo $teacher[$i]['tec_id'] ?>&tblCourse=tec_course&tblPerson=teacher&nameColumName=tec_name&nameColumId=tec_id"
                 class="btn-link custom-btn">Show Courses</a></td>
              <td>
              <a href="src/deleteRecord.php?id=<?php echo $teacher[$i]['tec_id'] ?>&tbname=teacher&key=tec_id&loc=displayTeacher.php" 
              onclick="return confirm('Are you sure?')" class="btn-ed-del">Delete</a>
              <a href="inputTeacher.php?id=<?php echo $teacher[$i]['tec_id'] ?>
                                           &name=<?php echo $teacher[$i]['tec_name'] ?>
                                           &a_deg=<?php echo $teacher[$i]['aca_deg'] ?>
                                           &e_deg=<?php echo $teacher[$i]['edu_deg'] ?>
                                           " class="btn-ed-del">Edit</a>
            </td>
            </tr>
            <?php
          }?>
        </tbody>
      </table>
        </div>
      <div class="btns-student-table">
      <a class="btn-link" href="inputTeacher.php">ADD Teacher</a>
      </div>
      <div class='card-courses <?php echo $showCardCourses ?>' >
        <span id="close-card-courses" onclick="closeCardCourses('displayTeacher.php')">X</span>
        <div class="info-card ">
          <h4>id: <?php echo $person['id'] ?></h4>
          <h4>name: <?php echo $person['name'] ?></h4>
        </div>
        <table class="courses-table">
          <thead>
            <tr>
              <th>Course Code</th>
              <th>Course Name</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i=0; $i < count($courses); $i++) { ?>
            <tr>
              <td><?php echo $courses[$i]['course_code'] ?></td>
              <td><?php echo $courses[$i]['course_name'] ?></td>
            </tr>
            <?php 
            }  ?>
          </tbody>
        </table>
     </div>
    </div>
    <script src="js/main.js"></script>

  </body>
</html>
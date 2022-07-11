<?php
  include_once "src/session.php";
  require_once "src/config.php";
  $conn = new mysqli($sn, $un, $pw, $nameDB);
  $students=[];
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM students";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    for ($i=0 ; $i < $result->num_rows ; $i++){
      $students[$i] = $result->fetch_assoc(); 
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
    <title>students show</title>
    <link rel="stylesheet" href="css/style.css"/>
  </head>
  <body>  
    <div class="containor">
  <?php include "main/header.php"; ?>
      <h1 class="stu-show-title">show student info</h1>
      <div class="table-wrap">
      <table class="student-table" id="stu-table">
        <thead>
          <tr>
            <th>Studetn ID</th>
            <th>Student Name</th>
            <th>Phone</th>
            <th>Colloge</th>
            <th>Department</th>
            <th>Complete Hours</th>
            <th>Courses</th>
            <th>Edit/Delete/Show</th>
          </tr>
        </thead>
        <tbody>
          <?php for ($i=0; $i < count($students); $i++) { 
          ?>
            <tr>
              <td><?php echo $students[$i]['stu_id'] ?></td>
              <td><?php echo $students[$i]['stu_name'] ?></td>
              <td><?php echo $students[$i]['stu_phone'] ?></td>
              <td><?php echo $students[$i]['stu_colloge'] ?></td>
              <td><?php echo $students[$i]['stu_dep'] ?></td>
              <td><?php echo $students[$i]['num_completed_hourse'] ?></td>
              <td>
                <a href="?id=<?php echo $students[$i]['stu_id'] ?>&tblCourse=completed_courses&tblPerson=students&nameColumName=stu_name&nameColumId=stu_id"
                 class="btn-link custom-btn">Show Courses</a>
              </td>
              <td>
                <a href="src/deleteRecord.php?id=<?php echo $students[$i]['stu_id'] ?>&tbname=students&key=stu_id&loc=displayStudent.php" 
                onclick="return confirm('Are you sure?')" class="btn-ed-del">Delete</a>
                <a href="inputStudent.php?id=<?php echo $students[$i]['stu_id'] ?>
                                           &name=<?php echo $students[$i]['stu_name'] ?>
                                           &s_phone=<?php echo $students[$i]['stu_phone'] ?>
                                           &s_col=<?php echo $students[$i]['stu_colloge'] ?>
                                           &s_dep=<?php echo $students[$i]['stu_dep'] ?>
                                           " class="btn-ed-del">Edit</a>
              </td>
            </tr>
            <?php
          }?>
        </tbody>
      </table>
      </div>
      <div class="btns-student-table">
      <a class="btn-link" href="inputStudent.php">ADD Student</a>
      </div>
    </div>
    <div class='card-courses <?php echo $showCardCourses ?>' >
        <span id="close-card-courses" onclick="closeCardCourses('displayStudent.php')">X</span>
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
     <script src="js/main.js"></script>

  </body>
</html>
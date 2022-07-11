<?php
  include_once "src/session.php";
  require_once "src/config.php";
  $conn = new mysqli($sn, $un, $pw, $nameDB);
  $classrooms=[];
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM classrooms";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    for ($i=0 ; $i < $result->num_rows ; $i++){
      $classrooms[$i] = $result->fetch_assoc(); 
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
    <title>Class Room show</title>
    <link rel="stylesheet" href="css/style.css"/>
  </head>
  <body>
    <div class="containor">
    <?php include "main/header.php"; ?>
    <h1 class="stu-show-title">show Class Room info</h1>
      <div class="table-wrap">
      <table class="student-table" id="stu-table">
        <thead>
          <tr>
            <th> Number</th>
            <th>Capacity</th>
            <th>Location</th>
            <th>Department</th>
            <th>Type</th>
            <th>Edit/Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php for ($i=0; $i < count($classrooms); $i++) { 
          ?>
           <!-- code_course,course_name,prequist, t_hourse,w_hourse-->
            <tr>
              <td><?php echo $classrooms[$i]['cr_id'] ?></td>
              <td><?php echo $classrooms[$i]['cr_capacity'] ?></td>
              <td><?php echo $classrooms[$i]['cr_location'] ?></td>
              <td><?php echo $classrooms[$i]['cr_dep'] ?></td>
              <td><?php echo $classrooms[$i]['cr_type'] ?></td>
              <td>
              <a href="src/deleteRecord.php?id=<?php echo $classrooms[$i]['cr_id']; ?>&tbname=classrooms&key=cr_id&loc=displayClassRoom.php"
               onclick="return confirm('Are you sure?')" class="btn-ed-del">Delete</a>
               <a href="inputClassRoom.php?id=<?php echo $classrooms[$i]['cr_id'] ?>
                                           &cpty=<?php echo $classrooms[$i]['cr_capacity'] ?>
                                           &loc=<?php echo $classrooms[$i]['cr_location'] ?>
                                           &dep=<?php echo $classrooms[$i]['cr_dep'] ?>
                                           &type=<?php echo $classrooms[$i]['cr_type'] ?>
                                           " class="btn-ed-del">Edit</a>
            </td>
            </tr>
            <?php
          }?>
        </tbody>
      </table>
      </div>
      <div class="btns-student-table">
      <a class="btn-link" href="inputClassRoom.php">ADD Courses</a>
      </div>
    </div>

  </body>
</html>
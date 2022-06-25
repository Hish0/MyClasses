<?php
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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>teacher show</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
  <div class="header">
  <a href="displayStudent.php">Student</a>
    <a href="displayTeacher.php">Teacher</a>
    <a href="displayCourses.php">Courses</a></div>
    <div class="containor">
      <h1 class="stu-show-title">show teacher info</h1>
      <div class="table-wrap">
      <table class="student-table" id="stu-table">
        <thead>
          <tr>
            <th>teacher ID</th>
            <th>teacher Name</th>
            <th>teacher week Hours</th>
            <th>teacher acdamic degree</th>
            <th>teacher edu degree</th>
            <th>Edit/Delete/Show</th>
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
                <!-- <form action="" method="post" onsubmit="return check(this);">
                <button type="submit" name="delete" value="" class="btn-ed-del">Delete</button>
                 <button type="submit" name="edite" value="edite" class="btn-ed-del">edit</button>
              </form> -->
              <a href="src/deleteRecord.php?id=<?php echo $teacher[$i]['tec_id'] ?>&tbname=teacher&key=tec_id&loc=displayTeacher.php" onclick="return confirm('Are you sure?')">Delete</a>
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
    </div>
    <script>
      function check(fm) {
        alert();
        
      }
    </script>
  </body>
</html>
<a href="edit.php?del=d&mid=<?php echo $students[$i]['stu_id'] ?>" onclick="return del();" ><img border="0" src="images/icon_delete.png" /></a>
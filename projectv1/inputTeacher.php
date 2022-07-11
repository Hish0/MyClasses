<?php
  include_once "src/session.php";
  require_once "src/config.php";
  require_once "src/teacherProssces.php";

  $conn = new mysqli($sn, $un, $pw, $nameDB);
  $data = [];
  if ($conn->connect_error) {
    echo"feild connction";
  }
  else {
    $sql = "SELECT code_course,course_name FROM courses ORDER BY lvl";
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
  $show='none';
  $info = [
    'id'=>'',
    'name'=>['','',''],
    'a_deg'=>'',
    'e_deg'=>''
  ];
  include_once "src/editData.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher</title>
    <link rel="stylesheet" href="css/style.css"/>
  </head>
  <body>
  <div class="containor">
  <?php include "main/header.php"; ?>
    <div class="inputs">
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h2>Teacher INFO</h2>
        <label for="fname">First Name</label>
          <input type="text" name="fname" id="fname" placeholder="First Name" 
          value="<?php echo $info['name'][0];?>" required/>
          <label for="mname">Middle Name</label>
          <input type="text" name="mname" id="mname" placeholder="Middle Name"
          value="<?php echo $info['name'][1];?>" required/>
          <label for="lname">Last Name</label>
          <input type="text" name="lname" id="lname" placeholder="Last Name"
          value="<?php echo $info['name'][2];?>" required/>
          <label for="tec_id">Teacher ID</label>
          <input type="text" name="tec_id" id="tec_id" placeholder="teacher ID" 
          value="<?php echo $info['id'];?>" required/>
          <label for="acde">Acadmic Degree</label>
          <input type="text" name="acde" id="acde" placeholder="acadmic degree" 
          value="<?php echo $info['a_deg'];?>" required/>
          <label for="edu_degree">Edu Degree</label>
          <input type="text" name="edu_degree" id="edu_degree" placeholder="Edu Degree" 
          value="<?php echo $info['e_deg'];?>" required/>

          <label for="courses" id="courses-title">Courses</label>
          <select name="courses[]" id="course" multiple required>
            <?php 
            for ($i=0; $i < count($data); $i++) { ?>
              <option value="<?php echo $data[$i]['code_course'] ?>">
                <?php echo $data[$i]['course_name'] ?>
              </option>
            <?php
            }
            ?>
          </select>
          <h4>press on ctrl+click mouse-r to multi choice</h4>
        <div>
          <p id="emptyInput" class="msgWarning" hidden>
            *Some of the required fields are empty, please fill them
          </p>
        </div>
        <div class="btns">
          <button name="submit" value="<?php echo $valMainBtn; ?>" class="btn"><?php echo $mainBtn; ?></button>
          <button type="button" class="btn"><a href="displayTeacher.php"> Show Teacher</a></button>
        </div>
      </form>
    </div>
    <div class="btns-student-table">
      <a class="btn-link <?php echo $show ?>" href="inputTeacher.php">ADD Courses</a>
    </div>
  </div>
    <script src=""></script>
  </body>
</html>

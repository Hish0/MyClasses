<?php
  include_once "src/session.php";
  require_once "src/config.php";
  require_once "src/studentProssces.php";
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
  $show='none';
  $info = [
    'id'=>'',
    'name'=>['','',''],
    's_phone'=>'',
    's_col'=>'',
    's_dep'=>''
  ];
  include_once "src/editData.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student</title>
    <link rel="stylesheet" href="css/style.css"/>
  </head>
  <body>
    <div class="containor">
  <?php include "main/header.php"; ?>
      <div class="inputs">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <h2>Student INFO</h2>
          <!-- <div class="name-inputs in-el-size"> -->
          <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname" placeholder="First Name"
            value="<?php echo $info['name'][0] ?>" required/>
          <label for="mname">Middle Name</label>
            <input type="text" name="mname" id="mname" placeholder="Middle Name" 
            value="<?php echo $info['name'][1] ?>" required/>
          <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname" placeholder="Last Name"
            value="<?php echo $info['name'][2] ?>" required/>
          <!-- </div> -->
          <!-- <div class="unvirsty-inputs in-el-size"> -->
          <label for="stu_id">Student ID</label>
            <input type="text" name="stu_id" id="stu_id" placeholder="Student ID"
            value="<?php echo trim($info['id']) ?>" required/>
          <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" placeholder="Phone Number"
            value="<?php echo trim($info['s_phone']) ?>" required/>
          <label for="colloge">Colloge</label>
            <input type="text" name="colloge" id="colloge" placeholder="Colloge"
            value="<?php echo trim($info['s_col']) ?>" required/>
          <label for="dep">Department</label>
            <input type="text" name="dep" id="dep" placeholder="deparment"
            value="<?php echo trim($info['s_dep']) ?>" required/>
          <!-- </div> -->
          <label for="courses" id="courses-title">Courses</label>
          <select name="courses[]" id="course" multiple required>
            <?php for ($i=0; $i < count($data); $i++) { ?>
                <option value="<?php echo $data[$i]['code_course'] ?>"><?php echo $data[$i]['course_name'] ?></option>
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
            <!-- <button name="submit" value="submit" class="btn">ADD</button> -->
            <button name="submit" value="<?php echo $valMainBtn; ?>" class="btn"><?php echo $mainBtn; ?></button>
            <button type="button" class="btn"><a href="displayStudent.php"> Show Student</a></button>
          </div>
        </form>
      </div>
      <div class="btns-student-table">
        <a class="btn-link <?php echo $show ?>" href="inputStudents.php">ADD Courses</a>
      </div>
    </div>
    <script src=""></script>
  </body>
</html>

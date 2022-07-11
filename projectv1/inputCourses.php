<?php
  include_once "src/session.php";
require_once "src/config.php";
  require_once "src/coursesProssces.php";
  $show='none';
  $info = [
    'id'=>'',
    'course_name'=>'',
    'lvl'=>'',
    'pre'=>'',
    'ch'=>'',
    'lh'=>''
  ];
  include_once "src/editData.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>courses</title>
    <link rel="stylesheet" href="css/style.css"/>
  </head>
  <body> 
    <div class="containor">
  <?php include "main/header.php"; ?>
      <div class="inputs">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <h2>Courses INFO</h2>
          <!-- <div class="name-inputs in-el-size"> -->
          <label for="ccode">Course Code</label>
            <input type="text" name="ccode" id="ccode" placeholder="Course Code"
            value="<?php echo trim($info['id']) ?>" required/>
          <label for="cname">Course Name</label>
            <input type="text" name="cname" id="cname" placeholder="Course Name"
            value="<?php echo trim($info['course_name']) ?>" required/>
          <label for="lvl">Course level</label>
            <input type="text" name="lvl" id="lvl" placeholder="Course level"
            value="<?php echo trim($info['lvl']) ?>" required/>
          <label for="cprequist">Prequist</label>
            <input type="text" name="cprequist" id="cprequist" placeholder="Prequist"
            value="<?php echo trim($info['pre']) ?>" required/>
          <!-- </div> -->
          <!-- <div class="unvirsty-inputs in-el-size"> -->
          <label for="cthours">Cridet Hours</label>
            <input type="text" name="cthours" id="cthours" placeholder="Cridet Hours"
            value="<?php echo trim($info['ch']) ?>" required/>
          <label for="cwhours">Lab Hours</label>  
            <input type="text" name="cwhours" id="cwhours" placeholder="Lab Hours"
            value="<?php echo trim($info['lh']) ?>" required/>

          <!-- </div> -->
          <div>
            <p id="emptyInput" class="msgWarning" hidden>
              *Some of the required fields are empty, please fill them
            </p>
          </div>
          <div class="btns">
            <!-- <button name="submit" value="submit" class="btn">ADD</button> -->
            <button name="submit" value="<?php echo $valMainBtn; ?>" class="btn"><?php echo $mainBtn; ?></button>
            <button type="button" class="btn"><a href="displayCourses.php"> Show Courses</a></button>
          </div>
        </form>
      </div>
      <div class="btns-student-table">
        <a class="btn-link <?php echo $show ?>" href="inputCourses.php">ADD Courses</a>
      </div>
    </div>
    <script src=""></script>
  </body>
</html>

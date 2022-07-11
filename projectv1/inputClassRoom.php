  <?php
  include_once "src/session.php";
  require_once "src/config.php";
  require_once "src/classRoomProssces.php";
  $show='none';
  $info = [
    'id'=>'',
    'cpty'=>'',
    'loc'=>'',
    'dep'=>'',
    'type'=>''
  ];
  include_once "src/editData.php";
  ?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>class room</title>
      <link rel="stylesheet" href="css/style.css"/>
    </head>
    <body>
      <div class="containor">
    <?php include "main/header.php"; ?>
        <div class="inputs">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <h2>Class Room INFO</h2>
          <!--  -->
          <label for="cr_num">Number</label>
            <input type="text" name="cr_num" id="cr_num" placeholder="Number of Calss Room"
            value="<?php echo trim($info['id']) ?>" required/>
          <label for="cr_capacity">Capacity</label>
            <input type="text" name="cr_capacity" id="cr_capacity" placeholder="Class Room Capacity"
            value="<?php echo trim($info['cpty']) ?>" required/>
          <label for="cr_location">Location</label>
            <input type="text" name="cr_location" id="cr_location" placeholder="Class Room Location"
            value="<?php echo trim($info['loc']) ?>" required/>
          <label for="cr_department">Department</label>
            <input type="text" name="cr_department" id="cr_department" placeholder="Class Room Department"
            value="<?php echo trim($info['dep']) ?>" required/>
          <label for="cr_type">Type</label>
            <input type="text" name="cr_type" id="cr_type" placeholder="Class Room Type"
            value="<?php echo trim($info['type']) ?>" required/>
          <!--  -->
          <div>
            <p id="emptyInput" class="msgWarning" hidden>
              *Some of the required fields are empty, please fill them
            </p>
          </div>
          <div class="btns">
            <button name="submit" value="<?php echo $valMainBtn; ?>" class="btn"><?php echo $mainBtn; ?></button>
            <button type="button" class="btn"><a href="displayClassRoom.php"> Show Class Room</a></button>
          </div>
        </form>
      </div>
      <div class="btns-student-table">
        <a class="btn-link <?php echo $show ?>" href="inputClassRoom.php">ADD Courses</a>
      </div>
      </div>
      <script src=""></script>
    </body>
  </html>

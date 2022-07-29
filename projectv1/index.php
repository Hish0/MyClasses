<?php
  include_once "src/session.php";
  $none = '';
  $showTable = '';
  if (isset($_GET['show'])) {
    $none = 'none';
    if (trim(strtolower($_GET['show']))=='lecture') {
        $showTable = 'lecture';
    }
    if (trim(strtolower($_GET['show']))=='teacher') {
        $showTable = 'teacher';
    }
  }
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
            <?php include "src/config.php"; ?>
            <div class="show-table-lecture <?php echo $none?>">
                <a href="index.php?show=lecture" class="btn-link">SHOW LABS TIMETABLE</a>
                <a href="index.php?show=teacher" class="btn-link">SHOW TEACHERS TIMETABLE</a>
            </div>
            <?php
            if ($showTable === 'lecture') {
                include_once "showTableCourse.php";
            }
            if ($showTable === 'teacher') {
                include_once "showTeatcherTable.php";
            }
            ?>
        </div>
    </body>
</html>
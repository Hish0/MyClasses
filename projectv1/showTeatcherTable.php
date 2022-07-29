<?php
    include_once "src/createTeacherTable.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <style>
table, th, td {
  border:1px solid black;
}
</style>
</head>
<body>
<table class="tame-table-lecture">
  <tr>
    <th>Coure Code</th>
    <th>Teacher Name</th>
    <th>Days</th>
    <th>Lab</th>
    <th>Lecture Time</th>
  </tr>
    <?php 
        for ($i=0; $i < count($teacherTable); $i++) {  
            if (!($teacherTable[$i]['code_course']==='N/A')) {
    ?>
  <tr>
    <td><?php echo $teacherTable[$i]['code_course'];?></td>
    <td><?php echo $teacherTable[$i]['teacher']; ?></td>
    <td>
        <?php
            for ($j=0; $j < count($teacherTable[$i]['days']); $j++) { 
                echo $teacherTable[$i]['days'][$j]."<br>";
            }
        ?>
    </td>
    <td>
        <?php
            for ($j=0; $j < count($teacherTable[$i]['time'] ); $j++) { 
                echo $teacherTable[$i]['time'][$j]."<br>";
            }
        ?>
    </td>
    <td>
        <?php
            for ($j=0; $j < count($teacherTable[$i]['classRoom'] ); $j++) { 
                echo $teacherTable[$i]['classRoom'][$j]."<br>";
            }
        ?>
    </td>
  </tr>
  <?php
        }
    }
  ?>
</table>
</body>
</html>



<?php include_once "src/createTable.php" ?>
<!DOCTYPE html>
<html>
  <style>
    table{
      width: 100%;
    }
    table,
    th,
    td {
      border: 1px solid black;
    }
  </style>
  <body>
    <div class="time-table">
    <?php
    $lab_i = 0;
    while ($lab_i != $numOfLabs){
    ?>  
      <h2>lab <?php echo $lab_i+1 ?></h2>
      <table>
        <tr>
          <td>Days\Time</td>
          <td>8:00-9:00</td>
          <td>9:00-10:00</td>
          <td>10:00-11:00</td>
          <td>11:00-12:00</td>
          <td>12:00-1:00</td>
          <td>1:00-2:00</td>
          <td>2:00-3:00</td>
          <td>3:00-4:00</td>
        </tr>
        <?php
        for ($i = 0; $i < count($days); $i++)
        {
        ?>
        <tr>
          <td><?php echo $days[$i] ?></td>
          <?php
          for ($j = 0; $j < $hours; $j++){
            ?>
            <td><?php echo $labs[$lab_i]['courses'][$i][$j]['code_course']."<br>".$labs[$lab_i]['courses'][$i][$j]['teacher']?></td>
            <?php
          }
          ?>
        </tr>
          <?php
        }
          ?>   
      </table>
    <?php
         $lab_i++;
    }
    ?>
    </div>
  </body>
</html>

<?php
    $feild = 'none';
    $success = 'none';
    if (isset($_POST['signin'])) {
        require_once "src/config.php";
        $username = $_POST["username"];
        $access = $_POST["acsses"];
        $password = $_POST["password"];
        $confirm = $_POST["confirm"];
        // check if the passwords is match
        if ($password === $confirm) {
            $conn = new mysqli($sn, $un, $pw, $nameDB);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            //insert query stament 
            $inserSql = "INSERT INTO users (u_name,access_pass,u_password) VALUE('$username','$access','$password');";
            // check the execute
            if ($conn->query($inserSql) === TRUE) {
                $feild='none';
                $success = '';
            } else {
                $feild='';
                $success = 'none';
                echo "Error: " . $inserSql . "<br>" . $conn->error;
            } 
            $conn->close();
        }  
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>hatem emhemed ramadan</title>
    <link rel="stylesheet" href="css/logsignForm.css" />
  </head>
  <body>
    <form
      action=""
      method="post"
      onsubmit="return validate(this);"
    >
      <a href="login.html" class="goto-btn">Go To login</a>
      <h1 class="title">Registration</h1>
      <label for="username">User Name</label>
      <input type="text" name="username" placeholder="user name" />
      <span id="erruname" class="errorMsg" hidden
        >This field is required, it cannot be empty</span
      >
      <div class="acsses-contanior">
        <lable>Accessibility:</lable>
        <input type="radio" name="acsses" value="1" id="admin" />
        <label for="admin">Admin</label>
        <input type="radio" name="acsses" value="0" id="user" />
        <label for="user">User</label>
      </div>
      <span id="erracsses" class="errorMsg" hidden
       >This field is required, it cannot be empty</span
      >
      <label for="password">Password</label>
      <input type="password" name="password" placeholder="Password" />
      <span id="errpass" class="errorMsg" hidden
        >This field is required, it cannot be empty</span
      >
      <label for="confPassword">Confirm Password</label>
      <input type="password" name="confirm" placeholder="Confirm Password" />
      <span id="errCpass" class="errorMsg" hidden
        >This field is required, it cannot be empty</span
      >
      <span id="errMatch" class="errorMsg" hidden></span>
      <button type="submit" id="buttonSubmit" name="signin" value="signin">
        SIGN UP
      </button>
    </form>
    <div class="data-submited <?php echo $success ?>">
        <img src="img/correct.png" alt="">
        <p class="submit-msg">submited done Successfully!! </p>
    </div>
    <div class="data-submited <?php echo $feild ?>">
        <img src="img/remove.png" alt="">
        <p class="submit-msg err">error, please make sure the entered data is correct before Submit</p>
        <p class="submit-msg err">or try later again!! </p>
    </div>
    <script src="js/validate.js"></script>
  </body>
</html>

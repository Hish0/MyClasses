<?php
    include_once "src/session.php";
    $feild = 'none';
    $success = 'none';
    if (isset($_POST['login'])) {
        require_once "src/config.php";
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        // check if the username and password is not empty
        if ($password !== "" && $username !== "") {
            $conn = new mysqli($sn, $un, $pw, $nameDB);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            //insert query stament 
            $selectSql = "SELECT u_id FROM users WHERE u_name = '$username' AND u_password = '$password';";
            // check the execute
            $resulte = $conn->query($selectSql);
            if ($resulte->num_rows > 0) {
                $feild='none';
                $_SESSION['uname'] = $username;
                header("location:index.php");//if the the user is there in database then go to home page
            } else {
                $feild='';
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
    <title>Log in</title>
    <link rel="stylesheet" href="css/formls.css" />
</head>
  <body>    
    <form
      action=""
      method="post"
      onsubmit="return validatelogin(this);"
      class="login-form"
    >
      <a href="signup.php" class="goto-btn">Go To Signup</a>
      <h1 class="title">Login</h1>
      <label for="username">User Name</label>
      <input type="text" name="username" placeholder="user name" />
      <span id="erruname" class="errorMsg" hidden
        >This field is required, it cannot be empty</span
      >
      <label for="password">Password</label>
      <input type="password" name="password" placeholder="Password" />
      <span id="errpass" class="errorMsg" hidden
        >This field is required, it cannot be empty</span
      >

      <button type="submit" id="btnSubmit" name="login" value="login">
        Log in
      </button>
    </form>
    <div class="data-submited <?php echo $feild ?>">
        <img src="img/remove.png" alt="">
        <p class="submit-msg err">User Name is Not Found or The Password is Wrong</p>
        <p class="submit-msg err">Please Make Sure from the Information or try later again!! </p>
    </div>
    <script src="js/valiDate.js"></script>
  </body>
</html>

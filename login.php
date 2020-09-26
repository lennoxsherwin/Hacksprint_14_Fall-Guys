<?php
session_start();

include "util.php";

$screen_name = basename($_SERVER['PHP_SELF']);

$salt = 'SsE';

if(isset($_POST['full_name']) && isset($_POST['password'])){
  unset($_SESSION['full_name']);
  unset($_SESSION['user_id']);
}

//When the log_in button is clicked
if(isset($_POST['email_id']) && isset($_POST['password']))
{

  if ( strlen($_POST['email_id']) < 1 || strlen($_POST['password']) < 1 )
  {
    $_SESSION['error'] = "Email ID and password are required";
    header("Location: login.php");
    return;
  }
    else
    {
      $check = hash('md5', $salt.$_POST['password']);
      $stmt = $pdo->prepare('SELECT user_id,user_type_id,full_name FROM user_master WHERE email_id = :email_id AND password = :password AND effective_end_dt IS NULL');
      $stmt->execute(array(':email_id'=>$_POST['email_id'], ':password'=>$check));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

          if($row !== false)
          {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_type_id'] = $row['user_type_id'];
            $_SESSION['full_name'] = $row['full_name'];

            if($_SESSION['user_type_id'] == 1){
              header('Location: admin/admin_dash/admin_dashboard.php');
              return;
            }
            else{
              header('Location: client/user_dashboard/dash.php');
              return;
            }
          }
          else
          {
            $_SESSION['error'] = "Incorrect email or password";
            header("Location: login.php");
            return;
          }
    }
  }
 ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&family=Roboto&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kloky</title>
</head>

<body id="login_body">
  <section>
    <div id="login_header" class="text-black text-center">
      <!-- <h1>Music<br> for every mood.</h1> -->
    </div>

    <div id="logout" style="display: none;"></div>

    <div id="login_block">

    <div id = "login_div" class="login_div">
      <h2>Log In</h2>
      <?php flashMessages();?>
      <form method="POST" name="sign_up_form">
        <input type="hidden" name="identificaton" value="1"/>
        <div class="user_box">
        <label for="email_id">
          Email Id
        </label>
        <input type="text" name="email_id" id="email_id" placeholder="xyz@xyz.com">
        </div>
        <div class="user_box">
        <label for="password">
          Password
        </label>
        <input type="password" name="password" id="password" placeholder="******">
        </div>
        <br>
        <a href="#">

          <span></span>
          <span></span>
          <button type="submit">
            Log In
          </button>
        </a>

        <br>
        <div id="createaccount">
          <a href="register.php">Create Account?</a>
        </div>
      </form>

    </div>

  </section>





   </body>
</html>

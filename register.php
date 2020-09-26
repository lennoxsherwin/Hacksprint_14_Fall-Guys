<?php
session_start();

include "util.php";

$salt = 'SsE';

if(isset($_POST['full_name']) || isset($_POST['user_id'])){
  unset($_SESSION['full_name']);
  unset($_SESSION['user_id']);
}
//When the sign_up button is clicked
  if(isset($_POST['nfull_name']) && isset($_POST['nemail_id']) && isset($_POST['npassword']))
  {

    if ( strlen($_POST['nfull_name']) < 1 || strlen($_POST['npassword']) < 1 || strlen($_POST['nemail_id']) < 1 )
    {
      $_SESSION['error'] = "Fill in all the fields";
      header("Location: login.php");
      return;
    }
      else
      {
        $date = date("yy-m-d");
        $pass = hash('md5', $salt.$_POST['npassword']);
        $stmt = $pdo->prepare('SELECT user_id FROM user_master WHERE email_id = :email_id AND effective_end_dt IS NULL');
        $stmt->execute(array(':email_id'=>$_POST['nemail_id']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row !== false)
            {
              $_SESSION['error'] = "User Account already exists. Please log in.";
              header("Location: login.php");
              return;
            }
            else
            {
              $sql="INSERT INTO
                    user_master
                    (user_type_id,full_name,password,email_id,effective_from_dt)
                    VALUES
                    (2,:full_name,:password,:email_id,:effective_from_dt)";
              $stmt = $pdo->prepare($sql);
              $stmt->execute(array(
                ':full_name' =>$_POST['nfull_name'],
                ':password' =>$pass,
                ':email_id' =>$_POST['nemail_id'],
                ':effective_from_dt' =>$date));

                $_SESSION['user_id'] = $pdo->lastInsertId();
                $_SESSION['user_type_id'] = 2;
                $_SESSION['full_name'] = $_POST['nfull_name'];
                header('Location: client/user_dashboard/dash.php');
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

    <div id="logout"></div>

    <div id = register_div class="login_div">
      <h2>Register</h2>
      <?php flashMessages();?>
      <form method="POST">
        <input type="hidden" name="identificaton" value="2"/>
        <div class="user_box">
         <label for="nfull_name">
             Full Name
         </label>

        <input type="text" name= "nfull_name" id="full_name" placeholder="John Doe">
        </div>
        <div class="user_box">
         <label for="email_id">
          Email Id
        </label>
        <input type="text" name="nemail_id" id="email_id" placeholder="xyz@xyz.com">
        </div>
        <div class="user_box">
        <label for="npassword">
          Password
        </label>
        <input type="password" name="npassword" id="password" placeholder="******">
        </div>
        <br>
        <a href="#">

          <span></span>
          <span></span>
          <button type="submit">
            Register Now
          </button>
        </a>
        <br>
        <div id="createaccount">
          <a href="login.php">Already have an Account?<br> Log In</a>

        </div>
      </form>

    </div>
    <br>
  </section>

    <footer id="footer">
      <div id="footer_contents">
      <li>Legal</li>
      <li>Privacy Center</li>
      <li>Privacy Policy</li>
      <li>Cookies</li>
      <li>About Ads</li>
    </div>
    </footer>

   </body>
</html>

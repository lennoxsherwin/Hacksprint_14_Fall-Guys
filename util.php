<?php
require_once "pdo.php";
//require_once "style.php";
function display_message() {
  if(isset($_SESSION['message'])) {
    $msg = $_SESSION['message'];
    echo "<script type='text/javascript'>alert('$msg');</script>";
    unset($_SESSION['message']);
  }
}
function flashMessages() {
  if(isset($_SESSION['error']))
  {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
  }
  if(isset($_SESSION['success']))
  {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
  }
}

function check_logged_in() {
  if(!isset($_SESSION['user_id'])) {
    die('ACCESS DENIED PLEASE LOG IN FIRST');
    return;
  }
}

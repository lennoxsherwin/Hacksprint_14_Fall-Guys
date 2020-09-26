<?php
session_start();
if(!isset($_SESSION['user_id'])) {
  die('ACCESS DENIED PLEASE LOG IN FIRST');
  return;
}
else{
    $user_id = $_SESSION['user_id'];
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600&family=Roboto&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dash</title>
</head>
<body>
  <div id="admin_greeting_div">
    <div id ="admin_dashboard"><h1>Admin Dashboard</h1></div>
    <div id = "logout"><a href="/hymn/logout.php"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i></a></div>
  </div>
  <div id="manimg"><img src="images/background.png"></div>
  <div id="admin_links_div">
    <ul>
    <li><a href ="/hymn/admin/genre_master.php">Add/Modify Genres</a></li>
    <li><a href ="/hymn/admin/artist_master.php">Add/Modify Artists</a></li>
    <li><a href ="/hymn/admin/mood_master.php">Add/Modify Moods</a></li>
    <li><a href ="/hymn/admin/song_master.php">Upload/Modify Songs</a></li>
    <li><a href ="/hymn/client/user_dashboard/dash.php">Music Player</a></li>
    </ul>
  </div>
 <script type="text/javascript">
 window.onload = function() {
    document.getElementById("logout").onclick = function() {
      var result = confirm("Are you sure you want to logout?");
      if(result)
       return true;
      else
       return false;
    }
  }
 </script>
</body>
</html>
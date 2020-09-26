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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600&family=Roboto&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <nav id="navigation">
            <div id="burger">
                <div class = "line 1"></div>
                <div class = "line 2"></div>
                <div class = "line 3"></div>
            </div>
            <div class="logo">hymn</div>

            <div id="logout"><a href="/hymn/logout.php"><i class="fa fa-sign-out fa-2x"></i></a></div>
        </nav>
        <?php if($_SESSION['user_type_id'] == 1): ?>
        <a href="/hymn/admin/admin_dash/admin_dashboard.php">
          <i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
        </a>
        <?php endif; ?>
        <a href="/hymn/client/moods/moods.php">
        <h2>Play songs based on your mood</h2>
      </a>
        <a href="/hymn/client/moods/moods.php">
        <div id ="main_mood_1">
        </div>
        </a>
        <br>
        <br>
        <a href="/hymn/client/artists/artists.php">
        <h2>Explore the latest artists</h2>
        </a>
        <a href="/hymn/client/artists/artists.php">
         <div id ="main_mood_2"> </div>
         </a><br>
         <br>

        <a href="/hymn/client/genres/genres.php">

        <h2>Explore your favourite genre</h2>
      </a>
     <a href="/hymn/client/genres/genres.php">
        <div id ="main_mood_3">
        </div>
        </a> <br>
        <br>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

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
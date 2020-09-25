<?php
session_start();
require_once "util.php";

if(!isset($_SESSION['user_id'])) {
  die('ACCESS DENIED PLEASE LOG IN FIRST');
  return;
}
else{
    $user_id = $_SESSION['user_id'];
}

if(isset($_POST['set_inactive'])){
  if(isset($_POST['delete'])){
    $date = date("yy-m-d");
    foreach($_POST['delete'] as $deleteid){
      $sql = "UPDATE genre
              SET effective_end_dt = :effective_end_dt
              WHERE genre_id = ".$deleteid;
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
        ':effective_end_dt' =>$date ));
      }
        $_SESSION['message']='Selected Genres Set Inactive';
        header('Location: genre_master.php');
        return;
    } else{
      $_SESSION['message']='No Genres are Chosen to Set Inactive';
      header('Location: genre_master.php');
      return;
    }
}

?>
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
      <div id="navigation">
        <nav class="nav">
            <div id="burger">
                <div class = "line 1"></div>
                <div class = "line 2"></div>
                <div class = "line 3"></div>
            </div>
            <div class="logo">hymn</div>
            <div class="profile"><img src="images/Account Icon.png"></div>
        </nav>
      </div>
        <h2>Favourites:</h2>

         </div>
       </div>
       <br><br><br><br><br><br><br><br><br><br><br>

       <div class="footer d-flex justify-content-center">

                       <div id="display_song_name" style="float:left;" class="song_name">Keanu  Reaves</div><br>
                       <div id="display_artist_name" style="" class="artist_name">Logic</div>

                  <div id="media_player">
                     <audio controls="controls" id="audio_player">
                      <!--<source src="<?= $row['song_path']?>" type="audio/ogg" />-->
                      <source src="<?= $row['song_path']?>" type="audio/mpeg" />
                      Your browser does not support the audio element.
                    </audio>
                  </div>

           </div>
<script src="client_javascript.js"></script>
</body>
</html>

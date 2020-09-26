<?php
session_start();
require_once "util.php";

$stmt = $pdo->query("SELECT mood_id,mood_name
                       FROM mood
                       WHERE effective_end_dt IS NULL");
  $moods = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <div id="logout">
              <a href="/hymn/logout.php">
              </div>
            <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
            </a>
        </nav>
      </div>
      <div>
      <a href="/hymn/client/user_dashboard/dash.php">
    <i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
    </a>
  </div>
        <h2>Moods</h2>
        <div id ="main_mood">
          <?php foreach ( $moods as $mood ): ?>

          <a href="" onclick="showSongs(<?= $mood['mood_id']?>)">
            <div class="moods1"> <?= $mood['mood_name']?></div>
          </a>

          <?php endforeach;  ?>
        </div>
        <br><br>
        <h2>Songs</h2>
        <!--<ul>
            <li>hello</li>
            <li></li>

        </ul>-->
        <div id="ajax_song_fields">
          <div id="field_append_div">
         </div>
       </div>
       <br><br><br><br><br><br><br><br><br><br><br>

           <div class="footer d-flex justify-content-center">
           <div id="song_info">
               <div id="display_song_name" class="song_name">Keanu  Reaves</div><br>
               <div id="display_artist_name"  class="artist_name">Logic</div>
               </div>
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

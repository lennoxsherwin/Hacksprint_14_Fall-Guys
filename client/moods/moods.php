<?php
session_start();
require_once "util.php";
?>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600&family=Roboto&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Change background image of a div by clicking on the button
            $(".moods2").click(function() {
                var imageUrl =  "images/2.png";

                $("body").css("background-image", "url(" + imageUrl + ")");
        ;
            });
            $(".moods1").click(function() {
                var imageUrl =  "images/1.png";

                $("body").css("background-image", "url(" + imageUrl + ")");

            });
            $(".moods3").click(function() {
                var imageUrl =  "images/3.png";

                $("body").css("background-image", "url(" + imageUrl + ")");
            });
            $(".moods4").click(function() {
                var imageUrl =  "images/4.png";

                $("body").css("background-image", "url(" + imageUrl + ")");
            });
            $(".moods5").click(function() {
                var imageUrl =  "images/5.png";

                $("body").css("background-image", "url(" + imageUrl + ")");
            });
        });
    </script>
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
        <h2>Moods</h2>
        <div id ="main_mood">
          <a href="" onclick="showSongs(1)">
            <div class="moods1"> Happy</div>
          </a>
          <a href="" onclick="showSongs(2)">
            <div class="moods2">Sad</div>
          </a>
          <a href="" onclick="showSongs(3)">
            <div class="moods3">Self</div>
          </a>
          <a href="" onclick="showSongs(4)">
            <div class="moods4">Chill</div>
          </a>
          <a href="" onclick="showSongs(5)">
            <div class="moods5">Study</div>
          </a>
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

<?php
require_once "pdo.php";
require_once "style.php";
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
function load_inactive_songs($pdo){
  $stmt = $pdo->prepare(
    'SELECT song_id,song_name,song_path,artist.artist_name,genre.genre_name,mood.mood_name,song_description,songs.effective_from_dt,songs.effective_end_dt
     FROM songs
     INNER JOIN genre ON songs.genre_id = genre.genre_id
     INNER JOIN mood ON songs.mood_id = mood.mood_id
     INNER JOIN artist ON songs.artist_id = artist.artist_id
     ORDER BY songs.effective_end_dt');

  $stmt->execute(array());
  $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $addresses;
}
function load_active_songs($pdo){
  $stmt = $pdo->prepare(
    'SELECT song_id,song_name,song_path,artist.artist_name,genre.genre_name,mood.mood_name,song_description,songs.effective_from_dt,songs.effective_end_dt
     FROM songs
     INNER JOIN genre ON songs.genre_id = genre.genre_id
     INNER JOIN mood ON songs.mood_id = mood.mood_id
     INNER JOIN artist ON songs.artist_id = artist.artist_id
     WHERE songs.effective_end_dt IS NULL
     ORDER BY song_name');

  $stmt->execute(array());
  $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $addresses;
}
function check_logged_in() {
  if(!isset($_SESSION['user_id'])) {
    die('ACCESS DENIED PLEASE LOG IN FIRST');
    return;
  }
}
function load_genres($pdo) {
  $stmt = $pdo->prepare(
    'SELECT genre_name
     FROM genre
     WHERE effective_end_dt IS NULL');
  $stmt->execute(array());
  $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $genres;
}
function load_artists($pdo) {
  $stmt = $pdo->prepare(
    'SELECT artist_name
     FROM artist
     WHERE effective_end_dt IS NULL');
  $stmt->execute(array());
  $artists = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $artists;
}
function load_moods($pdo) {
  $stmt = $pdo->prepare(
    'SELECT mood_name
     FROM mood
     WHERE effective_end_dt IS NULL');
  $stmt->execute(array());
  $moods = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $moods;
}

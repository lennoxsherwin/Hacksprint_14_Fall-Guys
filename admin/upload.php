<?php
session_start();
require_once "pdo.php";
if(isset($_POST['upload_song'])){

  if(isset($_POST['upload_id'])){
    $target_dir = "/hymn/admin/uploaded_songs/";
    $date = date("yy-m-d");

    foreach($_POST['upload_id'] as $deleteid){

      $target_file = $target_dir . basename($_FILES["song_file".$deleteid]["name"]);
      $file_name = $_FILES["song_file".$deleteid]['name'];
      $file_size =$_FILES["song_file".$deleteid]['size'];
      $file_type=$_FILES["song_file".$deleteid]['type'];
      $file_tmp =$_FILES["song_file".$deleteid]['tmp_name'];

      //$file_ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $file_ext=strtolower(end(explode('.',$_FILES["song_file".$deleteid]['name'])));
      $ext = "mp3";
      if(strcmp($file_ext,$ext) != 0){
         $_SESSION['message'] = "Extension not allowed, please choose a MP3 file.";
         header('Location: song_master.php');
         return;
      }

      /*if($file_size > 7340032){
         $_SESSION['message'] = 'File size must be less than 20 MB';
         header('Location: song_master.php');
         return;
      }*/

      move_uploaded_file($file_tmp,"uploaded_songs/".$file_name);

      $stmt = $pdo->prepare('SELECT genre_id FROM genre WHERE genre_name=:name');
      $stmt->execute(array(':name'=>$_POST['genre_name'.$deleteid]));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if( $row !== false ) {
          $genre_id = $row['genre_id'];
        } else {
          $_SESSION['error'] = "Choose an appropriate genre from the list given";
          header('Location: song_master.php');
          return;
        }

      $stmt = $pdo->prepare('SELECT artist_id FROM artist WHERE artist_name=:name');
      $stmt->execute(array(':name'=>$_POST['artist_name'.$deleteid]));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if( $row !== false ) {
          $artist_id = $row['artist_id'];
        } else {
          $_SESSION['error'] = "Choose an appropriate Artist from the list given";
          header('Location: song_master.php');
          return;
        }

        $stmt = $pdo->prepare('SELECT mood_id FROM mood WHERE mood_name=:name');
        $stmt->execute(array(':name'=>$_POST['mood_name'.$deleteid]));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if( $row !== false ) {
            $mood_id = $row['mood_id'];
          } else {
            $_SESSION['error'] = "Choose an appropriate Mood from the list given";
            header('Location: song_master.php');
            return;
          }

      $sql = "INSERT INTO songs
               (song_name,song_path,artist_id,genre_id,mood_id,song_description,effective_from_dt,created_by,last_updated_by)
               VALUES
               (:song_name,:song_path,:artist_id,:genre_id,:mood_id,:song_description,:effective_from_dt,:created_by,:last_updated_by)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
        ':song_name' =>$_POST['song_name'.$deleteid],
        ':song_path' =>$target_file,
        ':artist_id' =>$artist_id,
        ':genre_id' =>$genre_id,
        ':mood_id' =>$mood_id,
        ':song_description' =>$_POST['song_description'.$deleteid],
        ':effective_from_dt' =>$date,
        ':created_by' =>$user_id,
        ':last_updated_by' =>$user_id ));
    }
    $_SESSION['message'] = "Songs are uploaded";
    header('Location: song_master.php');
    return;
  }
  else {
    $_SESSION['message']='No songs are uploaded';
    header('Location: song_master.php');
    return;
}
}
?>

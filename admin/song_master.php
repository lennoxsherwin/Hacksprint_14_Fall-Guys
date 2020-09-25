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
$genres = load_genres($pdo);
$artists = load_artists($pdo);
$moods = load_moods($pdo);
//Loads the inactive address if the inactive_records_selection is set, else loads only the active records
if(isset($_SESSION['inactive_records_selection'])){
 $rows = load_inactive_songs($pdo);
}
else{
$rows = load_active_songs($pdo);
}

//IF THE SHOW INACTIVE RECORDS BUTTON IS CLICKED
if(isset($_POST['inactive_records_selection'])){
  $_SESSION['inactive_records_selection'] = "yes";
  header('Location: song_master.php');
  return;
}

//IF THE MAKE CHANGES BUTTON IS CLICKED
if(isset($_POST['edit'])) {
  if(isset($_POST['delete'])) {
    foreach($_POST['delete'] as $deleteid){

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

      $song_name = $_POST['song_name'.$deleteid.''];
      $song_description = $_POST['song_description'.$deleteid.''];
      $sql = "UPDATE songs
              SET song_name = :song_name,
                  song_description = :song_description,
                  artist_id = :artist_id,
                  genre_id = :genre_id,
                  mood_id = :mood_id,
                  last_updated_by = :last_updated_by
              WHERE song_id = ".$deleteid;
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
        ':song_name' => $song_name,
        ':song_description' => $song_description,
        ':artist_id' => $artist_id,
        ':genre_id' => $genre_id,
        ':mood_id' => $mood_id,
        ':last_updated_by' => $user_id));
    }
    $_SESSION['message'] = "Changes are saved";
    header('Location: song_master.php');
    return;
  }
  else {
    $_SESSION['message']='No Songs are Chosen to make changes';
    header('Location: song_master.php');
    return;
  }
}

?>
<html>
<head>
  <title>Song Master(Upload and Modify Songs)</title>
</head>
<body class="fourth_color">

  <div id="navbar"></div>
  <div class="second_color heading">
    <a href="/hymn/admin/uploaded_songs/Oru-Kal.mp3">
  <h1>Song Master(Upload and Modify Songs)</h1>
  </a>
</div>
<div id="close_button">
  <a href="/hymn/admin/admin_dash/admin_dashboard.html">
<i class="fa fa-times fa-5x" aria-hidden="true"></i>
</a>
</div>
<div class="">
  <input class="search_bar" id="myInput" type="text" placeholder="Search..">
</div>

<form id="upload_song_div" action="upload.php" class="fourth_color" enctype="multipart/form-data" name="add_screen_form" method="post">

  <table>
    <div class="">
    <thead class="table_head">
    <tr>
      <th scope="col" class="text-center"><i class="fa fa-check" aria-hidden="true"></i></th>
      <th scope="col"><b>Upload</b></th>
      <th scope="col"><b>Song Name</b></th>
      <th scope="col"><b>Artist</b></th>
      <th scope="col"><b>Genre</b></th>
      <th scope="col"><b>Mood</b></th>
      <th scope="col"><b>Song Description</b></th>
    </tr>
  </thead>
</div>

<tbody id="myTable">
</tbody>
  </table>
</div>

<div class="text-center">
  <button type="button" id="new_screen2" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;</button>
  <button type="submit button" class="btn btn-success" name="upload_song"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Upload Songs</button>
</div>
</form>



<form name="song_form" method="post">
  <div class="fourth_color" id="song_table">
  <table>
    <div class="">
    <thead class="table_head">
    <tr>
      <th scope="col" class="text-center"><i class="fa fa-check" aria-hidden="true"></i></th>
      <th scope="col"><b>Song ID</b></th>
      <th scope="col"><b>Song Name</b></th>
      <th scope="col"><b>Song Path</b></th>
      <th scope="col"><b>Artist</b></th>
      <th scope="col"><b>Genre</b></th>
      <th scope="col"><b>Mood</b></th>
      <th scope="col"><b>Song Description</b></th>
      <th scope="col"><b>Effective From Date</b></th>
      <th scope="col"><b>Effective End Date</b></th>
    </tr>
  </thead>
</div>
<div id="new_screen_div">
  <div id="logout"></div>
</div>
<div id="add_screen_heading">
</div>
<div id="make_changes_button">
</div>
  <tbody id="">
  <?php foreach ( $rows as $row ): ?>

    <?php
      if(isset($row['effective_end_dt'])){
        $active = "disabled";
      } else{
        $active = "";
      }
    ?>
      <tr>
        <th scope="row"><input type="checkbox" <?= $active ?> class="form-control-xs" name='delete[]' id="screen_id<?= $row['song_id'] ?>" value='<?= $row['song_id'] ?>' ></td>

      <td>
        <?= htmlentities($row['song_id']) ?>
      </td>

        <td hidden><?= htmlentities($row['song_name']) ?></td>
        <td><input type="text" maxlength="40" <?= $active ?> required onchange="check('screen_id<?= $row['song_id'] ?>')" class="form-control-sm" id="screen_name<?= $row['song_id'] ?>" name="unit_code<?= $row['song_id'] ?>" value="<?= htmlentities($row['song_name']) ?>"></input></td>

        <td hidden><?= htmlentities($row['song_path']) ?></td>
        <td><input type="text" maxlength="40" <?= $active ?> required onchange="check('screen_id<?= $row['song_id'] ?>')" class="form-control-sm" id="screen_name<?= $row['song_id'] ?>" name="unit_code<?= $row['song_id'] ?>" value="<?= htmlentities($row['song_path']) ?>"></input></td>

        <td hidden><?= htmlentities($row['artist_name']) ?></td>
        <td><input type="text" maxlength="40" <?= $active ?> required onchange="check('screen_id<?= $row['song_id'] ?>')" class="form-control-sm auto_artist" id="screen_name<?= $row['song_id'] ?>" name="unit_description<?= $row['song_id'] ?>" value="<?= htmlentities($row['artist_name']) ?>"></input></td>

        <td hidden><?= htmlentities($row['genre_name']) ?></td>
        <td><input type="text" maxlength="40" <?= $active ?> required onchange="check('screen_id<?= $row['song_id'] ?>')" class="form-control-sm auto_genre" id="screen_name<?= $row['song_id'] ?>" name="unit_code<?= $row['song_id'] ?>" value="<?= htmlentities($row['genre_name']) ?>"></input></td>

        <td hidden><?= htmlentities($row['mood_name']) ?></td>
        <td><input type="text" maxlength="40" <?= $active ?> required onchange="check('screen_id<?= $row['song_id'] ?>')" class="form-control-sm auto_mood" id="screen_name<?= $row['song_id'] ?>" name="unit_description<?= $row['song_id'] ?>" value="<?= htmlentities($row['mood_name']) ?>"></input></td>

        <td hidden><?= htmlentities($row['song_description']) ?></td>
        <td><input type="text" maxlength="200" <?= $active ?> required onchange="check('screen_id<?= $row['song_id'] ?>')" class="form-control-sm" id="screen_name<?= $row['song_id'] ?>" name="unit_code<?= $row['song_id'] ?>" value="<?= htmlentities($row['song_description']) ?>"></input></td>

        <td><?= htmlentities($row['effective_from_dt']) ?></td>
        <td><?= htmlentities($row['effective_end_dt']) ?></td>
      </tr>
  <?php endforeach;  ?>
</tbody>
  </table>

  <script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
</div>

<div id="button_field" class="text-center text-white a fourth_color clear">
  <button type="button" class="btn btn-dark" name="back"><a href="mood_master.php" class="text-white"><i class="fa fa-arrow-left" aria-hidden="true"></i> Mood Master</a></button>
  <button type="submit button" class="btn btn-success" name="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Make Changes To Selected Records</button>
  <button id="inactive_records_selection" name="inactive_records_selection" type="submit" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i> Show inactive records</button>
  <button type="button" id="new_screen" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> Upload new songs </button>
  <button type="submit button" class="btn btn-danger" name="set_inactive"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Make Selected Records Inactive</button>
</div>
</form>
<script>
  var artist_array = [];
  var genre_array = [];
  var mood_array = [];

  $( function() {
    <?php foreach($artists as $artist): ?>
      artist_array.push("<?= $artist['artist_name'] ?>");
    <?php endforeach ?>
    $( ".auto_artist" ).autocomplete({
      source: artist_array
    });
  });
  $( function() {
    <?php foreach($genres as $genre): ?>
      genre_array.push("<?= $genre['genre_name'] ?>");
    <?php endforeach ?>
    $( ".auto_genre" ).autocomplete({
      source: genre_array
    });
  });
  $( function() {
    <?php foreach($moods as $mood): ?>
      mood_array.push("<?= $mood['mood_name'] ?>");
    <?php endforeach ?>
    $( ".auto_mood" ).autocomplete({
      source: mood_array
    });
  });
  </script>

<script id="add_screen_template" type="text">
<tr id="@COUNT@">
<th scope="row" hidden><input type="checkbox" class="form-control-xs" name='upload_id[]' checked value='@COUNT@'></td>
    <td>
    <i class="fa fa-trash fa-lg" onclick="remove_element(@COUNT@)" style="margin-top:13px;" aria-hidden="true"></i>
    </td>
    <td>
    <!--<i class="fa fa-upload fa-lg" onclick="upload(@COUNT@)" style="margin-top:13px;" aria-hidden="true"></i>-->
    <input type="file" class="form-control-sm" id="song_file@COUNT@" name="song_file@COUNT@">
    </td>
    <td>
      <input type="text" class="form-control-sm" name="song_name@COUNT@" maxlength="15" placeholder="Song Name"></input>
    </td>
    <td>
      <input type="text" class="form-control-sm auto_artist" name="artist_name@COUNT@" maxlength="30" placeholder="Artist">
    </td>
    <td>
      <input type="text" class="form-control-sm auto_genre" name="genre_name@COUNT@" maxlength="30" placeholder="Genre">
    </td>
    <td>
      <input type="text" class="form-control-sm auto_mood" required name="mood_name@COUNT@" maxlength="30" placeholder="Mood">
    </td>
    <td>
      <input type="text" class="form-control-sm" required name="song_description@COUNT@" maxlength="20" placeholder="Song Description">
    </td>
  </tr>
</script>
<script>
var screen_count = 1;
var temp_screen_count = 1;

$('#new_screen2').click(function(event){
  event.preventDefault();
  document.getElementById("upload_song_div").style.display = "block";
  //document.getElementById("add_screen_heading").style.display = "block";
  //document.getElementById("make_changes_button").style.display = "block";
  //document.getElementById("screen_count").value = screen_count;
  //document.getElementById("address_count").value=screen_count;
  console.log("Screen block "+screen_count);
  var source=$("#add_screen_template").html();
  $('#myTable').append(source.replace(/@COUNT@/g,screen_count));
  screen_count++;
  temp_screen_count++;
  });
  $('#new_screen').click(function(event){
    event.preventDefault();
    document.getElementById("upload_song_div").style.display = "block";
    document.getElementById("song_table").style.display = "none";
    document.getElementById("button_field").style.display = "none";
    //document.getElementById("screen_count").value = screen_count;
    //document.getElementById("address_count").value=screen_count;
    console.log("Screen block "+screen_count);
    var source=$("#add_screen_template").html();
    $('#myTable').append(source.replace(/@COUNT@/g,screen_count));
    screen_count++;
    temp_screen_count++;
    $( function() {
      <?php foreach($artists as $artist): ?>
        artist_array.push("<?= $artist['artist_name'] ?>");
      <?php endforeach ?>
      $( ".auto_artist" ).autocomplete({
        source: artist_array
      });
    });
    $( function() {
      <?php foreach($genres as $genre): ?>
        genre_array.push("<?= $genre['genre_name'] ?>");
      <?php endforeach ?>
      $( ".auto_genre" ).autocomplete({
        source: genre_array
      });
    });
    $( function() {
      <?php foreach($moods as $mood): ?>
        mood_array.push("<?= $mood['mood_name'] ?>");
      <?php endforeach ?>
      $( ".auto_mood" ).autocomplete({
        source: mood_array
      });
    });
  });

</script>
</body>
<?php display_message();?>
</html>

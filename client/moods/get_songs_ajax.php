<?php
require_once "pdo.php";
require_once "util.php";
session_start();

$q = intval($_GET['q']);

$stmt = $pdo->prepare(
  "SELECT song_id,song_name,song_path,artist.artist_name
   FROM songs
   INNER JOIN artist ON songs.artist_id = artist.artist_id
   WHERE mood_id = :mood_id AND songs.effective_end_dt IS NULL
   ORDER BY song_name");
$stmt ->execute(array(
  ':mood_id' =>$q));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<table>
  <thead>
  <!--<tr>
    <th scope="col" class="text-center"><i class="fa fa-check" aria-hidden="true"></i></th>
    <th scope="col"><b>Song ID</b></th>
    <th scope="col"><b>Song Name</b></th>
  </tr>-->
</thead>
<tbody class="table_head" id="myTable" class="fourth_color">
    <input hidden name="screen_id_from_ajax" value="<?= $q ?>"></input>
    <?php foreach ( $rows as $row ): ?>
      <div style="border-radius:28px;margin-bottom:10px;width:100%;">
        <tr>

          <td scope="row" style="color:white;">
            <a href="<?= $row['song_path']?>" onclick="play_song('<?= $row['song_path']?>','<?= $row['song_name']?>','<?= $row['artist_name']?>')">
            <i style="color: #00008b;" class="fa fa-play-circle fa-3x" aria-hidden="true"></i>
          </a>
            <input type="text" hidden class="form-control-xs"
              name='field[]' id="field_id<?= $row['song_id'] ?>"
              value='<?= $row['song_id'] ?>' >
          </td>

          <td style="color:white;">
            <?= htmlentities($row['song_name']) ?>
          </td>

          <td style="color:white;">
            <?= htmlentities($row['artist_name']) ?>
          </td>

        </tr>
      </div>

    <?php endforeach; ?>
  </tbody>
    </table>

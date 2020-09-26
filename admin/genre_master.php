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


  //echo "<script>alert($_SESSION['message'])</script>";
//allowed_or_not(check_screen_permission($pdo,get_screen_id($pdo,basename($_SERVER['PHP_SELF']),$_SESSION['role_id']),$_SESSION['role_id']) );

//Loads the inactive address if the inactive_records_selection is set, else loads only the active records
if(isset($_SESSION['inactive_records_selection'])){
  $stmt = $pdo->query("SELECT genre_id,genre_name,effective_from_dt,effective_end_dt
                       FROM genre
                       ORDER BY effective_end_dt DESC");
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  unset($_SESSION['inactive_records_selection']);
}
else{
  $stmt = $pdo->query("SELECT genre_id,genre_name,effective_from_dt,effective_end_dt
                       FROM genre
                       WHERE effective_end_dt IS NULL
                       ORDER BY genre_name ASC");
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//IF THE SHOW INACTIVE RECORDS BUTTON IS CLICKED
if(isset($_POST['inactive_records_selection'])){
  $_SESSION['inactive_records_selection'] = "yes";
  header('Location: genre_master.php');
  return;
}

//If make the selected screens inactive button is clicked
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
//IF THE MAKE CHANGES BUTTON IS CLICKED
if(isset($_POST['edit'])) {
  if(isset($_POST['delete'])) {
    foreach($_POST['delete'] as $deleteid){
      $genre_name = $_POST['unit_code'.$deleteid.''];
      $sql = "UPDATE genre
              SET genre_name = :genre_name,
                  last_updated_by = :last_updated_by
              WHERE genre_id = ".$deleteid;
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
        ':genre_name' => $genre_name,
        ':last_updated_by' => $user_id));
    }
    $_SESSION['message'] = "Changes are saved";
    header('Location: genre_master.php');
    return;
  }
  else {
    $_SESSION['message']='No Genres are Chosen to make changes';
    header('Location: genre_master.php');
    return;
  }
}

//ADD NEW Genres TO THE Genre MASTER
if(isset($_POST['add_screens_button'])) {
  $screen_count = $_POST['screen_count'];
for($i=1 ; $i <= $screen_count ; $i++) {
  if(!isset($_POST['unit_code'.$i]) ){
    continue;
  }
  else {
    $date = date("yy-m-d");

    $sql = "INSERT INTO genre
             (genre_name,effective_from_dt,created_by,last_updated_by)
             VALUES
             (:genre_name,:effective_from_dt,:created_by,:last_updated_by)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      ':genre_name' =>$_POST['unit_code'.$i],
      ':effective_from_dt' =>$date,
      ':created_by' =>$user_id,
      ':last_updated_by' =>$user_id ));
    }
  }
  $_SESSION['message']='Units Added';
  header('Location: genre_master.php');
  return;
}
?>
<html>
<head>
  <title>UOM Master</title>
</head>
<body class="fourth_color">

  <div id="navbar"></div>
  <div class="second_color heading">
  <h1>Define Genre(Genre Master)</h1>
</div>
<div id="close_button">
  <a href="/hymn/admin/admin_dash/admin_dashboard.php">
<i class="fa fa-times fa-3x" aria-hidden="true"></i>
</a>
</div>
<div class="">
  <input class="search_bar" id="myInput" type="text" placeholder="Search..">
</div>

<form id="new_screen_div" class="fourth_color" name="add_screen_form" method="post">

    <div id="add_screen_heading" class="text-center first_color">
      <h5>Add Genre</h5>
   </div>
   <div id="add_new_screen_div">
     <!--THE NEW SCREENS ARE APPENDED HERE-->
   </div>

   <input type="hidden" name="screen_count" id="screen_count" value=""></input>

   <div id="make_changes_button" class="text-center fourth_color">
     <button class="btn btn-warning" name="add_screens_button"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Changes</button>
   </div>

</form>

<form name="screen_master_view" method="post">
  <div class="fourth_color" id="screen_table">
  <table>
    <div class="">
    <thead class="table_head">
    <tr>
      <th scope="col" class="text-center"><i class="fa fa-check" aria-hidden="true"></i></th>
      <th scope="col"><b>Genre ID</b></th>
      <th scope="col"><b>Genre Name</b></th>
      <th scope="col"><b>Effective From Date</b></th>
      <th scope="col"><b>Effective End Date</b></th>
    </tr>
  </thead>
</div>

  <tbody id="myTable">
  <?php foreach ( $rows as $row ): ?>

    <?php
      if(isset($row['effective_end_dt'])){
        $active = "disabled";
      } else{
        $active = "";
      }
    ?>
      <tr>
        <th scope="row"><input type="checkbox" <?= $active ?> class="form-control-xs" name='delete[]' id="screen_id<?= $row['genre_id'] ?>" value='<?= $row['genre_id'] ?>' ></td>

      <td>
        <?= htmlentities($row['genre_id']) ?>
      </td>

        <td hidden><?= htmlentities($row['genre_name']) ?></td>
        <td><input type="text" maxlength="40" <?= $active ?> required onchange="check('screen_id<?= $row['genre_id'] ?>')" class="form-control-sm" id="screen_name<?= $row['genre_id'] ?>" name="unit_code<?= $row['genre_id'] ?>" value="<?= htmlentities($row['genre_name']) ?>"></input></td>

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
  <button type="button" class="btn btn-dark" name="back"><a href="admin_dashboard.php" class="text-white"><i class="fa fa-arrow-left" aria-hidden="true"></i> Dashboard</a></button>
  <button type="submit button" class="btn btn-success" name="edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Make Changes To Selected Records</button>
  <button id="inactive_records_selection" name="inactive_records_selection" type="submit" class="btn btn-warning"><i class="fa fa-eye" aria-hidden="true"></i> Show inactive records</button>
  <button type="button" id="new_screen" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> Add new genre </button>
  <button type="submit button" class="btn btn-danger" name="set_inactive"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Make Selected Records Inactive</button>
  <button type="button" class="btn btn-primary"><a href="artist_master.php" class="text-white"><i class="fa fa-arrow-right" aria-hidden="true"></i> Artist Master</a></button>
</div>
</form>

<script>
var screen_count = 1;
var temp_screen_count = 1;

  $('#new_screen').click(function(event){
    event.preventDefault();
    document.getElementById("new_screen_div").style.display = "block";
    document.getElementById("add_screen_heading").style.display = "block";
    document.getElementById("make_changes_button").style.display = "block";
    document.getElementById("screen_count").value = screen_count;
    //document.getElementById("address_count").value=screen_count;
    console.log("Screen block "+screen_count);
    var source=$("#add_screen_template").html();
    $('#add_new_screen_div').append(source.replace(/@COUNT@/g,screen_count));
    screen_count++;
    temp_screen_count++;

  });
</script>

<script id="add_screen_template" type="text">
<div class="form-group row add_screen_row" id="@COUNT@">
   <label for="unit_code@COUNT@" class="col-sm-4 col-form-label"><i class="fa fa-angle-right" aria-hidden="true"></i> Genre Name</label>
   <div class="col-md-7">
     <input type="text" class="form-control" name="unit_code@COUNT@" id="unit_code@COUNT@" required placeholder="Genre Name">
   </div>
   <div class="col-sm-1">
   <i class="fa fa-trash fa-lg" onclick="remove_element(@COUNT@)" style="margin-top:13px;" aria-hidden="true"></i>
   </div>
 </div>
</script>
</body>
<?php display_message();?>
</html>

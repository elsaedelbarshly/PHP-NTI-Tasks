<?php

$totalDegree='';
$percantgeTotalDegree = '';
if($_POST)
{
    $totalDegree = $_POST['physics']+$_POST['chemistry']+$_POST['biology']+$_POST['mathematics']+$_POST['computer'] ;
    $percantgeTotalDegree = ($totalDegree /250) * 100;
}
// $grade='';
switch ($percantgeTotalDegree) {
    case $percantgeTotalDegree >=90:
        $grade = "Grade A";
        break;
    case $percantgeTotalDegree >=80:
        $grade = "Grade B";
        break;
    case $percantgeTotalDegree >=70:
        $grade = "Grade C";
        break;
    case $percantgeTotalDegree >=60:
        $grade = "Grade D";
        break;
    case $percantgeTotalDegree >=40:
        $grade = "Grade E";
        break;
    default:
    $grade = "Grade F";
        break;
}

$message = "Your Degree $percantgeTotalDegree % .<br>. Your $grade";

?>

<!doctype html>
<html lang="en">

<head>
  <title>Grade</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-12 mt-5">
        <h1 class="text-dark text-center h1"> The Grade </h1>
      </div>
      <div class="offset-4 col-4">
        <form method="post">

          <div class="form-group">
            <label for="name">Physics</label>
            <input type="text" name="physics" id="physics" class="form-control" placeholder="" aria-describedby="helpId">
          </div>

          <div class="form-group">
            <label for="name">Chemistry</label>
            <input type="text" name="chemistry" id="chemistry" class="form-control" placeholder="" aria-describedby="helpId">
          </div>
          
          <div class="form-group">
            <label for="name">Biology</label>
            <input type="text" name="biology" id="biology" class="form-control" placeholder="" aria-describedby="helpId">
          </div>

          <div class="form-group">
            <label for="name">Mathematics</label>
            <input type="text" name="mathematics" id="mathematics" class="form-control" placeholder="" aria-describedby="helpId">
          </div>
          
          <div class="form-group">
            <label for="name">Computer</label>
            <input type="text" name="computer" id="computer" class="form-control" placeholder="" aria-describedby="helpId">
          </div>

          <div class="form-group">
            <button name="Root" class="btn btn-dark rounded">Grade</button>
          </div>
        </form>

        <?php
        if (isset($message)) {
          echo "<div class='alert alert-success'> $message </div>";
        }
        ?>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
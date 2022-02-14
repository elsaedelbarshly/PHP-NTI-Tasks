<?php
session_start();
$questios = [
  'Are you satisfied with the level of cleanliness ?',
  'Are you satisfied with the service prices ?',
  'Are you satisfied with the nursing service ?',
  'Are you satisfied with the doctore service ?',
  'Are you satisfied with the calmness in the hospital ?'
];
if ($_POST) {
  $_SESSION['key']=$_POST['key'];
  header('Location: result.php');
}

// $review= [
//   'Bad',
//   'Good',
//   'Very Good',
//   'Excellent'
// ]
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <body>
  <div class="container">
    <div class="row">
      <div class="col-12 mt-5">
        <h1 class="text-dark text-center h1"> Bank </h1>
      </div>
      <div class="col-12">
        <form method="post">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Question</th>
                  <th scope="col">Bad</th>
                  <th scope="col">Good</th>
                  <th scope="col">Very Good</th>
                  <th scope="col">Excellent</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($questios as $key=>$questio){?>
                <tr class="text-center text-secondary">
                  <th scope="row"><?=$questio?></th>
                  <td><input class="form-check-input" type="radio" name="<?=$key?>" value="0" checked></td>
                  <td><input class="form-check-input" type="radio" name="<?=$key?>" value="3"></td>
                  <td><input class="form-check-input" type="radio" name="<?=$key?>" value="5"></td>
                  <td><input class="form-check-input" type="radio" name="<?=$key?>" value="10"></td>
                </tr>
                <?php }?>
              </tbody>
            </table>
            <button type="submit" class="btn btn-dark w-100 mt-0">Result</button>

        </form>
      </div>
  </div>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body> 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
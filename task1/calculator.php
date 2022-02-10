<?php


if ($_POST) {
    $num1 = $_POST['fnum'];
    $num2 = $_POST['snum'];
    $answer = 0;
   if($_POST['plus'] == 'plus')
   {
        $answer = $num1 + $num2;
   }elseif($_POST['minus'] == 'minus')
   {
    $answer = $num1 - $num2;
   }elseif($_POST['multip']== 'multip')
   {
    $answer = $num1 * $num2;
   }elseif($_POST['divide'] == 'divide')
   {
    $answer = $num1 / $num2;
   }

}

$message = "The Reuslt = $answer";

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
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
        <h1 class="text-dark text-center h1"> Calculator </h1>
      </div>
      <div class="offset-4 col-4">
        <form method="post">
          <div class="form-group">
            <label for="name">First Number</label>
            <input type="text" name="fnum" id="fnum" class="form-control" placeholder="" aria-describedby="helpId">
          </div>
          <div class="form-group">
            <label for="name">Second Number</label>
            <input type="text" name="snum" id="snum" class="form-control" placeholder="" aria-describedby="helpId">
          </div>
          <div class="form-group">
          <label for="products">Opration</label>
          <select name="product" id="products" class="form-control">
                            <option value="plus">+</option>
                            <option value="minus">-</option>
                            <option value="multip">*</option>
                            <option value="divide">/</option>
                        </select>
          </div>

          <div class="form-group">
            <button name="neg-pos" class="btn btn-dark rounded">Check Number</button>
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
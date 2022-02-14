<?php
session_start();
$questios = [
  'Are you satisfied with the level of cleanliness ?',
  'Are you satisfied with the service prices ?',
  'Are you satisfied with the nursing service ?',
  'Are you satisfied with the doctore service ?',
  'Are you satisfied with the calmness in the hospital ?'
];

?>



<!doctype html>
<html lang="en">
  <head>
    <title>Result</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="row">
          <div class="col-3 m-auto text-center mt-5">
              <h1 class="text-dark">Hospital Survey</h1>
          </div>
      </div>
      <div class="row">
        <div class="col-5 m-auto text-center mt-5">
            <table class="table">
                <thead class="thead-dark">
                    <tr class="text-dark text-center">
                        <th>Questions</th>
                        <th>Review</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($questios as $key=>$questio){?>
                    <tr class="text-center text-dark">
                        <th scope="row"><?=$questio?></th>
                        <td class="text-dark"><?php
                            session_start();
                            if ($_SESSION['Q1'] == 0) {
                                echo "Bad";
                            } elseif ($_SESSION['ke'] == 3) {
                                echo "Good";
                            } elseif ($_SESSION['Q1'] == 5) {
                                echo "Very Good";
                            } elseif ($_SESSION['Q1'] == 10) {
                                echo "Excellent";
                            }
                            ?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
      
    </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
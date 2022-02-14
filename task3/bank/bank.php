<?php

if($_POST)
{
    $errors=[];
    if(empty($_POST['username']))
    {
        $errors['username-required'] = "<div class='alert alert-danger'> UserName Is Required </div>";
    }
    if(empty($_POST['loanAmount']))
    {
        $errors['loanAmount-required'] = "<div class='alert alert-danger'> Loan Amount Is Required </div>";
    }
    if(empty($_POST['loanYear']))
    {
        $errors['loanYear-required'] = "<div class='alert alert-danger'> Loan Year Is Required </div>";
    }

    $year = $_POST['loanYear'];
    $bankBenefite = '';

    switch ( $year) {
        case $year > 0 && $year <= 3:
            $bankBenefite = 0.1;
            break;
        default:
            $bankBenefite = 0.15;
            break;
    }

    $benefiteValueInOneYear= $_POST['loanAmount'] * $bankBenefite;
    $totalBenefiteValue =  $benefiteValueInOneYear * $year;
    $loanAfterBenefite = $totalBenefiteValue + $_POST['loanAmount'];
    $monthly =  $loanAfterBenefite/($year*12);

//     $resulte = " <table class='table'>
//     <thead class='thead-dark'>
//         <tr>
//         <th scope='col'>User Name</th>
//         <th scope='col'>Interest rate</th>
//         <th scope='col'>Loan after interest</th>
//         <th scope='col'>Monthly</th>
//         </tr>
//     </thead>          
//     <tbody>
//         <tr>
//         <th scope='row'>{$_POST['username']}</th>
//         <td>$totalBenefiteValue</td>
//         <td>$loanAfterBenefite</td>
//         <td>$monthly</td>
//         </tr>
//     </tbody>
// </table>";

}

?>

<!doctype html>
<html lang="en">

<head>
  <title>Max</title>
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
        <h1 class="text-dark text-center h1"> Bank </h1>
      </div>
      <div class="offset-4 col-4">
        <form method="post">
          <div class="form-group">
            <label for="name">User Name</label>
            <input type="text" name="username" id="username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>" class="form-control" placeholder="" aria-describedby="helpId">
            <?php
                if(!empty($errors['username-required']))
                {
                    echo $errors['username-required'] ;
                }
            ?>
          </div>
          <div class="form-group">
            <label for="name">Loan amount</label>
            <input type="text" name="loanAmount" id="loanAmount" value="<?php if(isset($_POST['loanAmount'])){echo $_POST['loanAmount'];} ?>"class="form-control" placeholder="" aria-describedby="helpId">
            <?php
                if(!empty($errors['loanAmount-required']))
                {
                    echo $errors['loanAmount-required'] ;
                }
            ?>
          </div>
          <div class="form-group">
            <label for="name">Loan year</label>
            <input type="text" name="loanYear" id="loanYear" value="<?php if(isset($_POST['loanYear'])){echo $_POST['loanYear'];} ?>" class="form-control" placeholder="" aria-describedby="helpId">
            <?php
                if(!empty($errors['loanYear-required']))
                {
                    echo $errors['loanYear-required'] ;
                }
            ?>
          </div>
          <div class="form-group offset-4 col-3">
            <button name="neg-pos" class="btn btn-dark rounded">calclate</button>
          </div>
        </form>
      </div>
      <?php
          if($_POST) {
            if(empty($errors)) {  ?>
                <table class="table">
                      <thead class="thead-dark">
                          <tr>
                          <th scope="col">User Name</th>
                          <th scope="col">Interest rate</th>
                          <th scope="col">Loan after interest</th>
                          <th scope="col">Monthly</th>
                          </tr>
                      </thead>          
                      <tbody>
                          <tr>
                          <th scope="row"><?php echo $_POST['username']?></th>
                          <td><?=$totalBenefiteValue?></td>
                          <td><?=$loanAfterBenefite?></td>
                          <td><?=$monthly?></td>
                          </tr>
                      </tbody>
                  </table>
          <?php
            }
         }?>    
        <!-- <?php if($resulte){echo $resulte;}?> -->

    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
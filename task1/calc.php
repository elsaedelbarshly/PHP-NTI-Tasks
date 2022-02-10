<?php




?>


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Calculator</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <!-- start of header section -->
          <div class="row header">
            <div class="col-md-2">
              <span class="glyphicon glyphicon glyphicon-menu-hamburger"></span>
            </div>
            <div class="col-md-8">
              <p>Calculator</p>
            </div>
            <div class="col-md-2">
              <span class="glyphicon glyphicon glyphicon-cog"></span>
            </div>
          </div> <!-- header div -->
          <!-- end of header section -->
          <!-- start of textbox -->
          <div class="row teaxtbox">
            <div class="col-md-12 padding-reset">
              <input type="text" name="" value="">
            </div>
          </div>
          <!-- end of textbox -->

          <!-- start of button design -->
          <div class="row commonbutton">
            <!-- first row -->
            <div class="col-md-3">
              <input type="submit" name="" value="&#8730;" class="">
            </div>
            <div class="col-md-3">
              <input type="submit" name="" value="(" class="">
            </div>
            <div class="col-md-3">
              <input type="submit" name="" value=")" class="">
            </div>
            <div class="col-md-3">
              <input type="submit" name="" value="%" class="">
            </div>
            <!-- second row -->
            <div class="col-md-3">
              <input type="submit" name="7" value="7">
            </div>
            <div class="col-md-3">
              <input type="submit" name="8" value="8" class="">
            </div>
            <div class="col-md-3">
              <input type="submit" name="9" value="9" class="">
            </div>
            <div class="col-md-3">
              <input type="submit" name="/" value="/" class="">
            </div>
            <!-- third row -->
            <div class="col-md-3">
              <input type="submit" name="4" value="4" class="">
            </div>
            <div class="col-md-3">
              <input type="submit" name="5" value="5" class="">
            </div>
            <div class="col-md-3">
              <input type="submit" name="6" value="6" class="">
            </div>
            <div class="col-md-3">
              <input type="submit" name="x" value="X" class="">
            </div>
            <!-- four row -->
            <div class="col-md-3">
              <input type="submit" name="1" value="1" class="">
            </div>
            <div class="col-md-3">
              <input type="submit" name="2" value="2" class="">
            </div>
            <div class="col-md-3">
              <input type="submit" name="3" value="3" class="">
            </div>
            <div class="col-md-3">
              <input type="submit" name="4" value="-" class="">
            </div>
          </div> <!-- end of comonbutton div -->
          <!-- end of button design -->
          <!-- start of conflicting button area -->
          <div class="row conflict">
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-8">
                  <input type="submit" name="0" value="0" class="">
                </div>
                <div class="col-md-4">
                  <input type="submit" name="" value="." class="">
                </div>
                <div class="col-md-4">
                  <input type="submit" name="" value="Del" id="del">
                </div>
                <div class="col-md-8">
                  <!-- <input type="submit" name="" value="=" id="equal"> -->
                  <button name="equal" class="btn btn-dark rounded" id="equal">=</button>
                </div>
              </div>
            </div> <!-- end  zero, dot, del and equal sign div -->
            <div class="col-md-3">
                <input type="submit" name="
                =" value="+" id="plus">
            </div>
          </div> <!-- end of conflicting area -->
          <!-- end of conflicting button area -->
        </div>
      </div>
    </div>




  </body>
</html>

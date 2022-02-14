<?php
if ($_POST) {
    $errors = [];
    if (empty($_POST['clientName'])) {
        $errors['clientName'] = "<div class='alert alert-danger'> Name Is Required </div>";
    }
    if (empty($_POST['numOfProduct'])) {
        $errors['numOfProduct'] = "<div class='alert alert-danger'> No Of Products Is Required </div>";
    }
} ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Title</title>
</head>

<body>
    <div class="row">
        <div class="col-12 text-center mt-5">
            <h1 class="text-dark text-center h1">Super Market</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-3 text-center m-auto">
            <?php
            if (!empty($errors)) {
                foreach ($errors as $msg) {
                    echo $msg;
                }
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-4 text-left m-auto">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="clientName" class="form-label">Client Name :</label>
                    <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" value="<?= isset($_POST['clientName']) ? $_POST['clientName'] : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City :</label>
                    <select name="city" id="city" class="form-control">
                    <option value="Dammite">Dammite</option>
                    <option value="Cairo">Cairo</option>
                    <option value="Alex">Alex</option>
                    <option value="Others">Others</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="numOfProduct" class="form-label">No Of Products :</label>
                    <input type="number" class="form-control" id="numOfProduct" name="numOfProduct" placeholder="Products" value="<?= isset($_POST['numOfProduct']) ? $_POST['numOfProduct'] : '' ?>">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-dark rounded" name="formOne">Enter Products</button>
                </div>
                <?php if (empty($errors)) { ?>
                    <table class="table table-striped|sm|bordered|hover|inverse table-inverse table-responsive">
                        <thead class="thead-inverse|thead-default">
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantities</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_POST) {
                                if ($_POST['city'] == "Alex") {
                                    $delivery = 30;
                                } elseif ($_POST['city'] == "Dammite") {
                                    $delivery = 0;
                                } elseif ($_POST['city'] == "Cairo") {
                                    $delivery = 50;
                                } else {
                                    $delivery = 100;
                                }
                                for ($i = 1; $i <= $_POST['numOfProduct']; $i++) {
                                    $numOfProduct = $_POST['numOfProduct'];  ?>
                                    <tr>
                                        <td scope="row"><input type="text" name="productName[]" id="productName"></td>
                                        <td><input type="number" name="productPrice[]" id="productPrice"></td>
                                        <td><input type="number" name="productQuantity[]" id="productQuantity"></td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                    </table>


                    <?php if ($_POST) {
                                if (isset($_POST['formTwo'])) { ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Price</th>
                                        <th scope="col">Product Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $Totalprice = 0;
                                    for ($i = 0; $i < $_POST['numOfProduct']; $i++) {
                                        $Totalprice +=  $_POST['productPrice'][$i] * $_POST['productQuantity'][$i]; ?>
                                        <tr>
                                            <td><?= $_POST['productName'][$i] ?></td>
                                            <td><?= $_POST['productPrice'][$i] ?></td>
                                            <td><?= $_POST['productQuantity'][$i] ?></td>
                                        </tr>
                            <?php }
                                    if ($Totalprice < 1000) {
                                        $discount = 0;
                                        $totalAfterDiscount = ($discount * $Totalprice) + $Totalprice;
                                        $netTotal = $totalAfterDiscount + $delivery;
                                    } elseif ($Totalprice < 3000) {
                                        $discount = .1;
                                        $totalAfterDiscount = ($discount * $Totalprice) + $Totalprice;
                                        $netTotal = $totalAfterDiscount + $delivery;
                                    } elseif ($Totalprice < 4500) {
                                        $discount = .15;
                                        $totalAfterDiscount = ($discount * $Totalprice) + $Totalprice;
                                        $netTotal = $totalAfterDiscount + $delivery;
                                    } elseif ($Totalprice > 4500) {
                                        $discount = .2;
                                        $totalAfterDiscount = ($discount * $Totalprice) + $Totalprice;
                                        $netTotal = $totalAfterDiscount + $delivery;
                                    }
                                }
                            }; ?>
                                </tbody>
                            </table>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-dark rounded" name="formTwo">Receipt</button>
                            </div>
                        <?php  } ?>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-4 text-left m-auto">
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">Client Name</th>
                        <td><?= isset($_POST['clientName']) ? $_POST['clientName'] : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row">City</th>
                        <td><?= isset($_POST['city']) ? $_POST['city'] : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Total</th>
                        <td><?= isset($Totalprice) ?  $Totalprice : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Discount</th>
                        <td><?= isset($discount) ?  $discount : ''  ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Total After Discount</th>
                        <td><?= isset($totalAfterDiscount) ? $totalAfterDiscount : ''  ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Delivery</th>
                        <td><?= isset($delivery) ? $delivery : ''  ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Net Total</th>
                        <td><?= isset($netTotal) ? $netTotal : ''  ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
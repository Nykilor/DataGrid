<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        a {
            color: black;
        }

        th {
            text-transform: capitalize;
        }

        a[data-label="id"] {
            text-transform: uppercase;
        }

    </style>
    <title>Hello, world!</title>
</head>
<body>
<div class="container">
    <div class="row">
<?php
require __DIR__ . '/vendor/autoload.php';
try {
    $rows = json_decode(file_get_contents("data2.json"), true);
    $state = new \DataGrid\State\HttpState();
    $dataGrid = new \DataGrid\DataGrid\HtmlDataGrid();
    $config = new \DataGrid\Config\DefaultConfig();
    $config->addTextColumn("id");
    $config->addTextColumn("name");
    $config->addTextColumn("company");
    $config->addNumberColumn("age")->setNumberFormat("0", "", "");
    $config->addMoneyColumn("balance")->setCurrency(" USD");
    $config->addTextColumn("phone");
    $config->addTextColumn("email");


    echo $dataGrid->withConfig($config)->render($rows, $state);
} catch (Throwable $e) {
    echo '<div class="alert alert-danger" role="alert">&#9888; Bład krytyczny - "'.$e->getMessage().'"</div>';
}
?>
    </div>
</div>
<a href="data2.json">Click for the test data</a>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
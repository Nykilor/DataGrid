<?php
require __DIR__ . '/vendor/autoload.php';
echo "<pre>";
$rows = json_decode(file_get_contents("data.json"), true);
$state = new \DataGrid\State\HttpState();

//TODO 1. Sortowanie +
//     2. Pagniacja +
//     3. Wyglad
//     4. Sprawdzic czy wszystko działa (raportowanie bledow zrobic)
//     5. Dokeryzacja
//     6. Wstawienie na hosting
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

?>


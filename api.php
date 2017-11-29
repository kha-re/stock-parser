<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

//require __DIR__.'/vendor/autoload.php';
require __DIR__.'/simple_html_dom.php';

$s = (isset($_GET['s']) && trim($_GET['s']) !="") ? $_GET['s'] : "DB04";

$url = 'http://www.moneycontrol.com/stock-charts/x/charts/';
$html = file_get_html($url.$s);


$block = $html->find('.FL .MR10');

$title = $html->find('h1')[0]->plaintext;

$code = $html->find('.FL .gry10')[0]->plaintext;

$codeBSE = explode("|",$code)[0];
$codeNSE = explode("|",$code)[1];

$current = $html->find('#Bse_Prc_tick')[0]->plaintext;

$tables = $block[1]->find('table');

$table = $tables[0];


$rows = [];
foreach ($table->children() as $key=>$tr) {
    $cols=[];
    foreach ($tr->children() as $td) {
        $cols[] = $td->plaintext;    
    }
    $rows[] = $cols;
}


$data['codeBSE'] = $codeBSE;
$data['codeNSE'] = $codeNSE;
$data['name'] = $title;
$data['current'] = $current;

$data['BSE50'] = $rows[2][1];
$data['BSE200'] = $rows[4][1];

$change200 = -(($data['BSE200'] - $data['current'])*100)/$data['BSE200'];

$data['change200'] = number_format((float)$change200, 2, '.', '');;


header('Content-Type: application/json');
echo json_encode($data);
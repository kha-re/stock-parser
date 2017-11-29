<?php

$s = (isset($_GET['s']) && trim($_GET['s']) !="") ? $_GET['s'] : "DB04";

$data = file_get_contents("http://45.77.219.59/stock/api.php?s=".$s);

$data = json_decode($data);

$symbols = ["DB04","AT20"];

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $data->title; ?> - Shares</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css" rel="stylesheet" >
    <style type="text/css">
        .red{
            color:red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <h1><?php echo $data->title; ?></h1>
                <select name="" class="form-control">
                    <?php foreach($symbols as $symbol): ?>
                        <option value="<?php echo $symbol; ?>"><?php echo $symbol; ?></option>
                    <?php endforeach;?>
                </select>
                <table class="table">
                    <?php foreach($data->rows as $key=>$row): ?>
                        <tr class="<?php if($key==1) echo 'red'; ?>">
                            <?php foreach($row as $col): ?>
                                <td><?php echo $col; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        
    </script>
</body>
</html>
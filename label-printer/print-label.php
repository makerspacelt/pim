<?php

require_once('esim-label-generator/esimPrint.php');

$pngPath = (isset($_POST['pngPath'])) ? filter_var(trim($_POST['pngPath']), FILTER_SANITIZE_URL) : false;
$ep = new esimPrint();
$code = $ep->printPng($pngPath);

echo '<script type="text/javascript">window.close();</script>';

?>
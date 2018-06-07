<?php

require_once('esim-label-generator/esimPrint.php');

$pngPath = (isset($_POST['pngPath'])) ? filter_var(trim($_POST['pngPath']), FILTER_SANITIZE_URL) : false;
$ep = new esimPrint();
$code = $ep->printPng($pngPath);

$fp = fsockopen('print-label.lan', 80, $errno, $errstr);
if (!$fp) {
    echo "ERROR: $errno - $errstr<br />\n";
} else {
    fwrite($fp, $code);
    fread($fp, 26);
    fclose($fp);
    echo '<script type="text/javascript">window.close();</script>';
}

?>
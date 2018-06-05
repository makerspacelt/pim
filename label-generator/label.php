<?php

require_once('qrcode.php');
require_once('php-barcode-generator/BarcodeGenerator.php');
require_once('php-barcode-generator/BarcodeGeneratorPNG.php');

// nustatome konstantas
define('FONT_FILE', __DIR__.'/FreeMonoBold.ttf');
define('MARGIN', 10);
define('TITLE_LEN', 24);
define('MODEL_LEN', 24);

// Funkcija kuri sugeneruoja klaidos paveiksliuką
function generateErrorImg($errorText) {
    $baseImg = imagecreate(416, 320);
    $bg = imagecolorallocate($baseImg, 255, 255, 255);
    $black = imagecolorallocate($baseImg, 0, 0, 0);
    $yCoord = 50;
    imagestring($baseImg, 5, 50, $yCoord, 'Nu... negerai!', $black);
    $strArr = explode('\n', $errorText);
    foreach ($strArr as $str) {
        $yCoord += 20;
        imagestring($baseImg, 5, 50, $yCoord, $str, $black);
    }
    header("Content-type: image/png");
    imagepng($baseImg);
    imagedestroy($baseImg);
}

// pasiimam kintamuosius ir apvalom, kad nebūtų purvini
$title = (isset($_GET['title'])) ? filter_var(trim($_GET['title']), FILTER_SANITIZE_STRING) : false;
$model = (isset($_GET['model'])) ? filter_var(trim($_GET['model']), FILTER_SANITIZE_STRING) : false;
$code = (isset($_GET['code'])) ? filter_var(trim($_GET['code']), FILTER_SANITIZE_STRING) : false;
$url = (isset($_GET['url'])) ? filter_var(trim($_GET['url']), FILTER_SANITIZE_URL) : false;
$params = false;
if (isset($_GET['params']) && (count($_GET['params']) > 0)) {
    $params = array();
    foreach ($_GET['params'] as $key => $value) {
        $params[$key] = filter_var(trim($value), FILTER_SANITIZE_STRING);
    }
}

// apkarpome pavadinimą ir modelį, kad nebūtų per ilgas, ribojam iki 24 simbolių
$title = substr($title, 0, TITLE_LEN-1).(strlen($title) > TITLE_LEN-1 ? '~' : '');
$model = substr($model, 0, MODEL_LEN-1).(strlen($model) > MODEL_LEN-1 ? '~' : '');

// patikriname ar bent vienas iš reikiamų parametrų yra tuščias
// ir jeigu bent vieno trūksta, tai rodome klaidą
if (!$title || !$model || !$code || !$url || !$params) {
    generateErrorImg('Perduoti ne visi parametrai :(');
    die();
}

// reiktų patikrinti ar yra mums taip reikalingas font'as
if (!file_exists(FONT_FILE)) {
    generateErrorImg('Nerastas srifto failas:\n  \''.FONT_FILE.'\'');
    die();
}

// pradedam generuoti etiketę
// etiketės matmenys 52x40mm, printeris palaiko 8 pikselius per milimetrą,
// tai 416x320 pilnai padengtas be marginų
$baseImg = imagecreate(416, 320);

$bg = imagecolorallocate($baseImg, 255, 255, 255); // background'as balta spalva
$black = imagecolorallocate($baseImg, 0, 0, 0); // tekstas juoda

// pavadinimas ir modelis
imagettftext($baseImg, 20, 0, MARGIN, 30, $black, FONT_FILE, $title);
imagettftext($baseImg, 20, 0, MARGIN, 55, $black, FONT_FILE, $model);
imageline($baseImg, MARGIN, 65, imagesx($baseImg)-MARGIN, 65, $black);

// įkeliam QR kodą
$qrSize = 170;
$qr = QRCode::getMinimumQRCode($url, QR_ERROR_CORRECT_LEVEL_L)->createImage(8, 4);
imagecopyresized(
    $baseImg, $qr,
    (imagesx($baseImg)-$qrSize)-MARGIN,
    (imagesy($baseImg)-$qrSize)-MARGIN,
    0, 0, $qrSize, $qrSize, imagesx($qr), imagesy($qr)
);

// įkeliam barkodą
// info dėl built-in fontų dydžio: https://docstore.mik.ua/orelly/webprog/pcook/ch15_06.htm
$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
$barcode = imagecreatefromstring($generator->getBarcode($code, $generator::TYPE_INTERLEAVED_2_5_CHECKSUM, 1.8));
$barcodeLen = imagesx($barcode);
imagecopy(
    $baseImg, $barcode,
    (imagesx($baseImg)-$barcodeLen)-MARGIN, 75,
    0, 0,
    imagesx($barcode), imagesy($barcode)
);
imagestring($baseImg, 5, (imagesx($baseImg)-(strlen($code)*9))-MARGIN, 75+imagesy($barcode), $code, $black);

// pridedame įrankio parametrus
$y = 85;
$fontSize = 13;
foreach ($params as $key => $param) {
    imagettftext($baseImg, $fontSize, 0, MARGIN, $y, $black, FONT_FILE, $key.': '.$param);
    $y += $fontSize+5;
}

header("Content-type: image/png");
imagepng($baseImg);

imagedestroy($baseImg);

?>
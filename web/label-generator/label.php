<?php

require_once('qrcode.php');
require_once('php-barcode-generator/BarcodeGenerator.php');
require_once('php-barcode-generator/BarcodeGeneratorPNG.php');

// nustatome konstantas
define('FONT_FILE', __DIR__.'/FreeMonoBold.ttf');
define('MARGIN', 10);
define('TITLE_LEN', 14);
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
$title = mb_strtoupper(mb_substr($title, 0, TITLE_LEN-1)).(mb_strlen($title) > TITLE_LEN-1 ? '~' : '');
$model = mb_substr($model, 0, MODEL_LEN-1).(mb_strlen($model) > MODEL_LEN-1 ? '~' : '');

// patikriname ar bent vienas iš reikiamų parametrų yra tuščias
// ir jeigu bent vieno trūksta, tai rodome klaidą
if (!$title || !$code || !$url) {
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
imagettftext($baseImg, 35, 0, MARGIN, 40, $black, FONT_FILE, $title);
imagettftext($baseImg, 20, 0, MARGIN, 70, $black, FONT_FILE, $model);
imageline($baseImg, MARGIN, 120, imagesx($baseImg)-MARGIN, 120, $black);

// įkeliam QR kodą
$qrSize = 170;
$qr = QRCode::getMinimumQRCode($url, QR_ERROR_CORRECT_LEVEL_L)->createImage(8, 4);
imagecopyresized(
    $baseImg, $qr,
    (imagesx($baseImg)-$qrSize)-MARGIN,
    (imagesy($baseImg)-$qrSize)-MARGIN-10,
    0, 0, $qrSize, $qrSize, imagesx($qr), imagesy($qr)
);

// įkeliam barkodą
// info dėl built-in fontų dydžio: https://docstore.mik.ua/orelly/webprog/pcook/ch15_06.htm
$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
$barcode = imagecreatefromstring($generator->getBarcode($code, $generator::TYPE_INTERLEAVED_2_5_CHECKSUM));
imagecopy(
    $baseImg, $barcode,
    MARGIN, (imagesy($baseImg)-imagesy($barcode))-MARGIN-10,
    0, 0,
    imagesx($barcode), imagesy($barcode)
);
imagestring($baseImg, 5, MARGIN, (imagesy($baseImg)-15)-imagesy($barcode)-MARGIN-12, $code, $black);

// pridedame įrankio parametrus
$y = 160;
$fontSize = 15;
$lineLen = 15;
if ($params && (count($params) > 0) && (!isset($params[0]))) {
    foreach ($params as $key => $param) {
        $line = $key.': '.$param;
        imagettftext($baseImg, $fontSize, 0, MARGIN, $y, $black, FONT_FILE,
            mb_substr($line, 0, $lineLen).(mb_strlen($line) > $lineLen ? '~' : '')
        );
        $y += $fontSize+8;
    }
} else {
    imagettftext($baseImg, $fontSize, 0, MARGIN, $y, $black, FONT_FILE, 'Parametrų nėra');
}

header("Content-type: image/png");
imagepng($baseImg);

imagedestroy($baseImg);

?>
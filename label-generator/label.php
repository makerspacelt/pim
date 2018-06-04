<?php

// mūsų naudojamas šrifto failas
define('FONT_FILE', 'FreeMonoBold.ttf');

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
if (isset($_GET['params']) && (count($_GET['params'] > 0))) {
    $params = array();
    foreach ($_GET['params'] as $key => $value) {
        $params[$key] = filter_var(trim($value), FILTER_SANITIZE_STRING);
    }
}

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
imagettftext($baseImg, 20, 0, 10, 30, $black, FONT_FILE, $title);
imagettftext($baseImg, 20, 0, 10, 55, $black, FONT_FILE, $model);
imageline($baseImg, 10, 65, imagesx($baseImg)-10, 65, $black);



header("Content-type: image/png");
imagepng($baseImg);

imagedestroy($baseImg);

?>
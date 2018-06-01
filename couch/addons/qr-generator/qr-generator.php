<?php
/*
    Addon'as kuris pagal duotus parametrus sugeneruoja QR kodą
    ir gražina teksto forma
*/

if (!defined('K_COUCH_DIR')) die(); // cannot be loaded directly

class QRGenerator_class {
    
    static function qrgenerator($params, $node) {
        include('phpqrcode.php');
        return join("\n", QRcode::text('PHP QR Code :)'));
    }
    
}

$FUNCS->register_tag('qrgenerator', array('QRGenerator_class', 'qrgenerator'));
?>
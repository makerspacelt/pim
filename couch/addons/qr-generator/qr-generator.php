<?php
/*
    Addon'as kuris pagal duotus parametrus sugeneruoja QR kodą
    ir gražina teksto forma
*/

if (!defined('K_COUCH_DIR')) die(); // cannot be loaded directly

require_once('phpqrcode.php');

class QRGenerator_class {
    
    static function qrgenerator($params, $node) {
        if ((count($params) > 0) && ($params[0]['lhs'] == 'type')) {
            switch ($params[0]['rhs']) {
                case 'png': return 'shit';
                case 'text': return join("\n", QRcode::text('PHP QR Code :)'));
            }
        }
        return '';
    }
    
}

$FUNCS->register_tag('qrgenerator', array('QRGenerator_class', 'qrgenerator'));
?>
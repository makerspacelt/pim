<?php
/*
    Addon'as kuris sugeneruoja nauj� unikal� kod� �rankiui
*/

if (!defined('K_COUCH_DIR')) die(); // cannot be loaded directly

class code_generator_class {
    
    static function generate($params, $node) {
        return '1234567891';
    }
    
}

$FUNCS->register_tag('generate-code', array('code_generator_class', 'generate'));
?>
<?php
/*
    Addon'as kuris duotą tekstą paverčia į suderinamą su JSON'u
*/

if (!defined('K_COUCH_DIR')) die(); // cannot be loaded directly

class JSONify_class {
    
    static function jsonify($params, $node) {
        // paimam visą tekstą kas yra nurodyta tag'e
        $text = '';
        foreach($node->children as $child) {
            $text .= $child->get_HTML();
        }
        return json_encode($text);
    }
    
}

$FUNCS->register_tag('jsonify', array('JSONify_class', 'jsonify'));
?>
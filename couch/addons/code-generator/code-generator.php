<?php
/*
    Addon'as kuris sugeneruoja naujà unikalø kodà árankiui
*/

if (!defined('K_COUCH_DIR')) die(); // cannot be loaded directly

class code_generator_class {
    
    function generate($params) {
        global $DB, $TAGS, $PAGE;
        // echo '<pre>'; print_r($this->page); die();
        // if( $PAGE->page_name != '' ) return 'qwqwq';
        if ((count($params) > 0) && ($params[0]['lhs'] == 'field_name') && ($params[0]['rhs'] != '')) {
            $rs = $DB->raw_select(sprintf('SELECT %1$s.value, %2$s.name FROM %1$s RIGHT JOIN %2$s ON %2$s.id = %1$s.field_id WHERE %2$s.name = \'%3$s\' AND %1$s.value != \'\' AND %1$s.value = \'%4$s\'',
            K_TBL_DATA_TEXT, K_TBL_FIELDS, $params[0]['rhs'], '6432154698'));
            // echo '<pre>'; print_r($rs); die();
            return 'asasasasasasa';
        } else {
            return 'zzzzz';
        }
    }

}

$FUNCS->register_tag('generate-code', array('code_generator_class', 'generate'));
?>
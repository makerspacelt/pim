<?php
/*
    Addon'as kuris sugeneruoja naujà unikalø kodà árankiui
    TODO: kodà turi generuoti tik kuriant naujà áranká admin panelëje,
    dabar já generuoja (bet niekur neiðveda) kai ateini á puslapá taip pat.
*/

if (!defined('K_COUCH_DIR')) die(); // cannot be loaded directly

class code_generator_class {
    
    private function generateCode() {
        $code = '';
        for ($i = 0; $i < 11; $i++) {
            $code .= strval(rand(0, 9));
        }
        return $code;
    }
    
    public function generate($params) {
        global $DB;
        
        if ((count($params) > 0) && ($params[0]['lhs'] == 'field_name') && ($params[0]['rhs'] != '')) {
            $exists = true;
            $tries = 0;
            while ($exists) {
                $tries++;
                $code = $this->generateCode();
                $rs = $DB->raw_select(sprintf('SELECT %1$s.value, %2$s.name FROM %1$s RIGHT JOIN %2$s ON %2$s.id = %1$s.field_id WHERE %2$s.name = \'%3$s\' AND %1$s.value != \'\' AND %1$s.value = \'%4$s\'',
                K_TBL_DATA_TEXT, K_TBL_FIELDS, $params[0]['rhs'], $code));
                if (count($rs) == 0) $exists = false;
            }
            // echo $tries;
            return $code;
        } else {
            return '';
        }
    }

}
$codeGen = new code_generator_class();
$FUNCS->register_tag('generate-code', array($codeGen, 'generate'));
?>
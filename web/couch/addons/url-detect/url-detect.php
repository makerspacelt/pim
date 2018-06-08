<?php
/*
    Addon'as kuris prideda tag'ą <cms:url_detect>...</cms:url_detect> į framework'ą kad būtų
    galima apsupti norimą tekstą kuriame gali būti nuorodų ir rastas nuorodas apsupa su
    <a href=...></a> tag'ais kad būtų paspaudžiamos.
*/

if (!defined('K_COUCH_DIR')) die(); // cannot be loaded directly

class UrlDetect {
    
    static function url_detect($params, $node) {
        // paimam visą tekstą kas yra nurodyta tag'e
        $text = '';
        foreach($node->children as $child) {
            $text .= $child->get_HTML();
        }
        $text = preg_replace('#(?xi)\b((?:https?://|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`\!()\[\]{};:\'".,<>?«»“”‘’]))#i', '<a href="$0" target="_blank">$0</a>', trim($text));
        return $text;
    }
    
}

$FUNCS->register_tag('url_detect', array('UrlDetect', 'url_detect'));
?>
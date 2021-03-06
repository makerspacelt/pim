<?php
    // �ia vienintelis priimtinas b�das nerodyti CMS'o info apa�ioje, kad b�t� validus JSON'as
    // galioja tik �itam puslapyje... manau k�r�jas nesupyks ;) 
    define('K_PAID_LICENSE', 1);
    require_once( 'couch/cms.php' );
?>
<cms:template name='tools_json_template' hidden='1' order='101' />

<cms:if "<cms:not_empty "<cms:gpc 't' method='get' default='' />" />">
    <cms:set arg="<cms:php>
            $argArr = explode('|', $_GET['t']);
            array_walk($argArr, function(&$value, $key) { $value = 'tool_tags='.$value; });
            echo implode('|', $argArr);
        </cms:php>" />
</cms:if>

<cms:content_type 'application/json'/>
[
<cms:pages masterpage='tool.php' orderby='weight' order='asc' page_name='NOT default-page' custom_field="<cms:show arg />">
    {
        "tool_name": "<cms:show k_page_name />",
        "tool_title": <cms:jsonify><cms:show k_page_title /></cms:jsonify>,
        "tool_barcode": "<cms:show tool_barcode />",
        "tool_desc": "<cms:addslashes><cms:show tool_desc /></cms:addslashes>",
        "tool_shop_links": <cms:jsonify><cms:show tool_shop_links /></cms:jsonify>,
        "tool_date": "<cms:show tool_date />",
        "tool_price": "<cms:show tool_price />",
        "tool_params": [
            <cms:show_repeatable 'tool_params'>
                <cms:if "<cms:not_empty tool_param_name />">
                    {
                        "tool_param_name": <cms:jsonify><cms:show tool_param_name /></cms:jsonify>,
                        "tool_param_value": <cms:jsonify><cms:show tool_param_value /></cms:jsonify>
                    }<cms:if k_count ne k_total_records>,</cms:if>
                </cms:if>
            </cms:show_repeatable>
        ],
        "tool_service_log": [
            <cms:show_repeatable 'tool_service_log'>
                <cms:if "<cms:not_empty tool_service_job />">
                    <cms:jsonify><cms:show tool_service_job /></cms:jsonify><cms:if k_count ne k_total_records>,</cms:if>
                </cms:if>
            </cms:show_repeatable>
        ],
        "tool_tags": [
            <cms:related_pages field='tool_tags'>
                "<cms:show k_page_name />"<cms:if k_count ne k_total_records>,</cms:if>
            </cms:related_pages>
        ],
        "tool_photos": [
            <cms:reverse_related_pages field='tool_img_gallery' masterpage='gallery.php' orderby='weight' order='asc'>
                "<cms:show gg_image />"<cms:if k_count ne k_total_records>,</cms:if>
            </cms:reverse_related_pages>
        ]
    }<cms:if "<cms:not k_paginated_bottom />">,</cms:if>
</cms:pages>
]

<?php COUCH::invoke(); ?>
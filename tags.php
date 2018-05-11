<?php require_once( 'couch/cms.php' ); ?>
<cms:template name='tool_tags_template' title='Etiketės' clonable='1' order='2'>
    <cms:config_list_view exclude='default-page'>
        <cms:field 'k_selector_checkbox' />
        <cms:field 'k_page_title' sortable='0' />
        <cms:field 'k_actions' />
    </cms:config_list_view>
</cms:template>
<?php COUCH::invoke(); ?>
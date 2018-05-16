<?php require_once( 'couch/cms.php' ); ?>
<cms:template name='tool_tags_template' title='Etiketės' clonable='1' order='2'>
    <cms:config_list_view exclude='default-page'>
        <cms:field 'k_selector_checkbox' />
        <cms:field 'k_page_title' sortable='0' />
        <cms:field 'k_actions' />
    </cms:config_list_view>
</cms:template>

<cms:embed 'head.php' />
<cms:embed 'header.php' />
<div class="container">
    <div class="row">
    <cms:embed 'sidebar.php' />
        <div class="col-lg-9">
            <div class="row my-4">
                <cms:pages masterpage='tool.php' orderby='weight' order='asc' page_name='NOT default-page' custom_field="tool_tags=<cms:gpc 't' method='get' default='' />">
                    <cms:embed 'tool_card.php' />
                </cms:pages>
            </div>
        </div>
    </div>
</div>
<cms:embed 'foot.php' />

<?php COUCH::invoke(); ?>
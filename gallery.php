<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Galerija' clonable='1' gallery='1'>
    <cms:config_list_view orderby='weight' order='asc' exclude='default-page'>
        <cms:field 'k_up_down' />
        <cms:field 'k_page_title' sortable='0' />
    </cms:config_list_view>

    <cms:editable
        name='gg_image'
        label='Nuotrauka'
        width='1500'
        quality='80'
        show_previews='1'
        preview_height='200'
        enforce_max='1'
        type='image'
    />
    
    <cms:editable
        name='gg_thumb'
        assoc_field='gg_image'
        label='Nuotraukos miniatūra'
        width='115'
        height='115'
        enforce_max='1'
        type='thumbnail'
    />
    
    <cms:editable
        name='tool_img_gallery'
        label='-'
        type='relation'
        masterpage='tool.php'
        has='one'
        no_gui='1'
    />
</cms:template>

<cms:redirect url="<cms:link masterpage='index.php' />" permanently='1' />

<?php COUCH::invoke(); ?>
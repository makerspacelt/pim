<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Galerija' clonable='1' dynamic_folders='1' gallery='1'>
    <cms:editable
        name='gg_image'
        label='Nuotrauka'
        width='500'
        show_previews='1'
        preview_height='200'
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
<?php COUCH::invoke(); ?>
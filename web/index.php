<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Pagrindinis' order='0'>
    <cms:editable
        name='site_logo'
        label='Puslapio logo'
        type='image'
        show_preview='1'
        preview_width='75'
        preview_height='75'
        width='150'
        height='150'
        order='1'
    />
    
    <cms:editable
        name='site_favicon'
        label='Favikona'
        type='thumbnail'
        show_preview='0'
        crop='1'
        width='16'
        height='16'
        assoc_field='site_logo'
        show_preview='1'
        order='2'
    />
    
    <cms:editable
        name='site_title'
        label='Puslapio pavadinimas'
        type='text'
        order='3'
    />
</cms:template>

<cms:embed 'head.php' />
<cms:embed 'header.php' />
<div class="container">
    <div class="row">
    <cms:embed 'sidebar.php' />
        <div class="col-lg-9" id="results">
            <div class="row my-4">
                <cms:set searchTerm="<cms:gpc 'search_input' method='post' default='' />" />
                <cms:if "<cms:not_empty searchTerm />">
                    <cms:set searchTerm="
                        <cms:php>
                            if (is_numeric(trim('<cms:show searchTerm />')) && (strlen('<cms:show searchTerm />') >= 10)) {
                                if (strlen('<cms:show searchTerm />') == 11) {
                                    echo substr('<cms:show searchTerm />', 0, -1);
                                } else {
                                    echo '<cms:show searchTerm />';
                                }
                            } else {
                                echo '<cms:show searchTerm />';
                            }
                        </cms:php>
                    "/>
                    <cms:search masterpage='tool.php' keywords=searchTerm>
                        <cms:if k_total_records eq '1'>
                            <cms:redirect url="<cms:show k_page_link />#tool_content" />
                        </cms:if>
                        <cms:embed 'tool_card.php' />
                        <cms:no_results>
                            <cms:embed 'nieko_nerasta.php' />
                        </cms:no_results>
                    </cms:search>
                <cms:else />
                    <cms:pages masterpage='tool.php' orderby='weight' order='asc' page_name='NOT default-page'>
                        <cms:embed 'tool_card.php' />
                        <cms:no_results>
                            <cms:set nn_text='Įrankių dar nėra' />
                            <cms:embed 'nieko_nerasta.php' />
                        </cms:no_results>
                    </cms:pages>
                </cms:if>
            </div>
        </div>
    </div>
</div>
<cms:embed 'foot.php' />
<?php COUCH::invoke(); ?>
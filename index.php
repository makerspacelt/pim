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

        <div class="col-lg-9">
            <div class="row my-4">
                <!-- pirma patikriname ar bando listinti irankius per tag'us -->
                <cms:set toolTag="<cms:gpc 'tag' method='get' default='' />" />
                <cms:if "<cms:not_empty toolTag />">
                    <cms:capture into='toolTagPageCount'>
                        <cms:pages masterpage='tool.php' orderby='weight' order='asc'
                            page_name='NOT default-page' custom_field="tool_tags=<cms:show toolTag />"
                            count_only='1' />
                    </cms:capture>
                    <cms:if "<cms:show toolTagPageCount />">
                        <cms:set listingTemplateUrl="<cms:link 'index.php' />" />
                        <cms:pages masterpage='tool.php' orderby='weight' order='asc' page_name='NOT default-page' custom_field="tool_tags=<cms:show toolTag />">
                            <cms:embed 'tool_card.php' />
                        </cms:pages>
                    <cms:else />
                        <div class="col-lg-12">
                            <h4 class="alert alert-info text-center">
                                Nieko nerasta pagal užklausą
                            </h4>
                        </div>
                    </cms:if>
                <cms:else />
                    <!-- jeigu ne, tai gal bando per paieska? -->
                    <cms:if "<cms:show searchCount />">
                        asasa
                    <cms:else />
                        <cms:pages masterpage='tool.php' orderby='weight' order='asc' page_name='NOT default-page'>
                            <cms:embed 'tool_card.php' />
                        </cms:pages>
                    </cms:if>
                </cms:if>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<cms:embed 'foot.php' />
<?php COUCH::invoke(); ?>
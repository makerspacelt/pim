<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Pagrindinis'>
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
                <cms:pages masterpage='tool.php' orderby='weight' order='asc' page_name='NOT default-page'>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="<cms:show k_page_link />">
                            <cms:if "<cms:reverse_related_pages field='tool_img_gallery' masterpage='gallery.php' count_only='1' />">
                                <cms:reverse_related_pages field='tool_img_gallery' masterpage='gallery.php' limit='1' orderby='weight' order='asc'>
                                    <img class="card-img-top" src="<cms:show gg_image />" alt="įrankio nuotrauka">
                                </cms:reverse_related_pages>
                            <cms:else />
                                <img class="card-img-top" src="<cms:show k_site_link />/images/defaut-tool-pic-listing.png" alt="įrankio nuotrauka">
                            </cms:if>
                        </a>
                        <div class="card-body">
                            <h5 class="card-title tool-listing-title"><a href="<cms:show k_page_link />"><cms:show k_page_title /></a></h5>
                            <h6 class="card-subtitle mb-3 text-muted"><cms:show tool_barcode /></h6>
                            <p class="card-text tool-listing-text"><cms:show tool_desc /></p>
                        </div>
                        <div class="card-footer">
                            <cms:related_pages field='tool_tags'>
                                <a href="<cms:show k_page_link />"><small class="text-muted"><nobr>#<cms:show k_page_name /></nobr></small></a>
                            </cms:related_pages>
                        </div>
                    </div>
                </div>
                </cms:pages>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<cms:embed 'foot.php' />
<?php COUCH::invoke(); ?>
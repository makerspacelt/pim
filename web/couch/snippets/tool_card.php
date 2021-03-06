<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <a href="<cms:show k_page_link />">
            <cms:reverse_related_pages field='tool_img_gallery' masterpage='gallery.php' limit='1' orderby='weight' order='asc'>
                <img class="card-img-top" src="<cms:show gg_image />" alt="įrankio nuotrauka">
                <cms:no_results>
                    <img class="card-img-top" src="images/default-tool-pic-listing.png" alt="įrankio nuotrauka">
                </cms:no_results>
            </cms:reverse_related_pages>
        </a>
        <div class="card-body">
            <h5 class="card-title tool-listing-title"><a href="<cms:show k_page_link />#tool_content"><cms:show k_page_title /> <cms:show tool_model /></a></h5>
            <h6 class="card-subtitle mb-3 text-muted"><cms:show tool_barcode /></h6>
            <p class="card-text tool-listing-text"><cms:nl2br><cms:show tool_desc /></cms:nl2br></p>
        </div>
        <div class="card-footer">
            <cms:related_pages field='tool_tags'>
                <a href="<cms:add_querystring k_template_link "t=<cms:show k_page_name />" />"><small class="text-muted"><nobr>#<cms:show k_page_name /></nobr></small></a>
            </cms:related_pages>
        </div>
    </div>
</div>
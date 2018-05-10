<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Įrankiai' clonable='1'>
    <cms:config_list_view orderby='weight' order='asc' exclude='default-page'>
        <cms:field 'k_selector_checkbox' />
        <cms:field 'k_page_title' sortable='0' />
        <cms:field 'k_page_date' />
        <cms:field 'k_up_down' />
        <cms:field 'k_actions' />
    </cms:config_list_view>

    <cms:editable
        name='tool_barcode'
        label='Barkodas'
        type='text'
        order='1'
    />
    
    <cms:editable
        name='tool_desc'
        label='Aprašymas'
        type='textarea'
        order='2'
    />
    
    <cms:editable
        name='tool_photos'
        label='Nuotraukos'
        type='reverse_relation'
        masterpage='gallery.php'
        field='tool_img_gallery'
        anchor_text='Peržiūrėti nuotraukas'
        order='3'
    />
    
    <cms:editable
        name='tool_tags'
        label='Etiketės'
        type='relation'
        masterpage='tags.php'
        order='4'
    />
    
    <cms:editable
        name='tool_info_group'
        label='Papildoma informacija'
        type='group'
        collapsed='1'
        order='5'
    />
    <cms:editable
        name='tool_shop_links'
        label='Kur galima pirkti?'
        type='textarea'
        group='tool_info_group'
    />
    <cms:editable
        name='tool_price'
        label='Kaina'
        type='text'
        group='tool_info_group'
    />
    <cms:editable
        name='tool_date'
        label='Įsigyjimo data'
        type='text'
        group='tool_info_group'
    />
    
    <cms:editable
        name='tool_params_group'
        label='Parametrai'
        type='group'
        collapsed='1'
        order='6'
    />
    <cms:repeatable name='tool_params' label='&nbsp;' group='tool_params_group'>
        <cms:editable
            name='tool_param_name'
            label='Parametro vardas'
            type='text'
        />
        <cms:editable
            name='tool_param_value'
            label='Parametras'
            type='text'
        />
    </cms:repeatable>
    
    <cms:editable
        name='tool_service_log_group'
        label='Atlikti priežiūros darbai'
        type='group'
        collapsed='1'
        order='7'
    />
    <cms:repeatable name='tool_service_log' label='&nbsp;' group='tool_service_log_group'>
        <cms:editable
            name='tool_service_job'
            type='textarea'
        />
    </cms:repeatable>
</cms:template>

<cms:embed 'head.php' />
<cms:embed 'header.php' />
<div class="container">
  <div class="row">
    <cms:embed 'sidebar.php' />

    <div class="col-lg-9">

      <div class="card mt-4">
        <cms:capture into='toolImgCount'>
            <cms:reverse_related_pages field='tool_img_gallery' masterpage='gallery.php' count_only='1' />
        </cms:capture>
        <cms:if toolImgCount>
            <div id="toolCarouselIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <cms:repeat count=toolImgCount startCount='0'>
                        <li data-target="#toolCarouselIndicators" data-slide-to="<cms:show k_count />" <cms:if k_count eq '0'>class="active"</cms:if>></li>
                    </cms:repeat>
                </ol>
                <div class="carousel-inner">
                    <cms:reverse_related_pages field='tool_img_gallery' masterpage='gallery.php' orderby='weight' order='asc'>
                        <div class="carousel-item item <cms:if k_count eq '1'>active</cms:if>">
                            <img class="d-block w-100" src="<cms:show gg_image />?auto=yes">
                        </div>
                    </cms:reverse_related_pages>
                    <a class="carousel-control-prev" href="#toolCarouselIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Praeitas</span>
                    </a>
                    <a class="carousel-control-next" href="#toolCarouselIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Sekantis</span>
                    </a>
                </div>
            </div>
        <cms:else />
            <img class="card-img-top img-fluid" src="<cms:show k_site_link />/images/defaut-tool-pic.png" alt="įrankio foto">
        </cms:if>
        <div class="card-body">
          <h3 class="card-title">Product Name</h3>
          <h4>$24.99</h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente dicta fugit fugiat hic aliquam itaque facere, soluta. Totam id dolores, sint aperiam sequi pariatur praesentium animi perspiciatis molestias iure, ducimus!</p>
          <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
          4.0 stars
        </div>
      </div>
      <!-- /.card -->

      <div class="card card-outline-secondary my-4">
        <div class="card-header">
          Product Reviews
        </div>
        <div class="card-body">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
          <small class="text-muted">Posted by Anonymous on 3/1/17</small>
          <hr>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
          <small class="text-muted">Posted by Anonymous on 3/1/17</small>
          <hr>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
          <small class="text-muted">Posted by Anonymous on 3/1/17</small>
          <hr>
          <a href="#" class="btn btn-success">Leave a Review</a>
        </div>
      </div>
      <!-- /.card -->

    </div>
    <!-- /.col-lg-9 -->

  </div>
</div>
<cms:embed 'foot.php' />
<?php COUCH::invoke(); ?>
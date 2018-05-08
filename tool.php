<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Įrankiai' clonable='1'>
    <cms:editable
        name='tool_barcode'
        label='Barkodas'
        type='text'
    />
    
    <cms:editable
        name='tool_desc'
        label='Aprašymas'
        type='nicedit'
    />
    
    <cms:editable
        name='tool_info_group'
        label='Papildoma informacija'
        type='group'
        collapsed='1'
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
        name='tool_params_group'
        label='Parametrai'
        type='group'
        collapsed='1'
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
    />
    <cms:repeatable name='tool_service_log' label='&nbsp;' group='tool_service_log_group'>
        <cms:editable
            name='tool_service_job'
            type='richtext'
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
        <img class="card-img-top img-fluid" src="http://placehold.it/900x400" alt="">
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
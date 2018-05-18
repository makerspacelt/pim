<?php require_once( 'couch/cms.php' ); ?>
<cms:embed 'head.php' />
<cms:embed 'header.php' />
<div class="container">
    <div class="row">
        <cms:embed 'sidebar.php' />
        <div class="col-lg-9">
            <img class="img-fluid" src="images/404-img.jpg">
        </div>
    </div>
</div>
<cms:embed 'foot.php' />
<?php COUCH::invoke(); ?>
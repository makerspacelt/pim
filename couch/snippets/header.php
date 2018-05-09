<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a href="<cms:show k_site_link />">
        <cms:capture into='cur_site_logo'>
            <cms:get_custom_field var='site_logo' masterpage='index.php' />
        </cms:capture>
        <cms:if "<cms:not_empty cur_site_logo />">
            <img src="<cms:show cur_site_logo />" class="site-logo" />
        </cms:if>
        
        <cms:capture into='cur_site_title'>
            <cms:get_custom_field var='site_title' masterpage='index.php' />
        </cms:capture>
        <cms:if "<cms:not_empty cur_site_title />">
            <div class="navbar-brand"><cms:show cur_site_title /></div>
        </cms:if>
        
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="<cms:show k_admin_link />">Prisijungti</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
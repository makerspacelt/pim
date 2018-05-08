<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a href="<cms:show k_site_link />">
        <img src="<cms:get_custom_field var='site_logo' masterpage='index.php' />" class="site-logo" /><div class="navbar-brand"><cms:get_custom_field var='site_title' masterpage='index.php' /></div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Prisijungti</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
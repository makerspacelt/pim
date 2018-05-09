<div class="col-lg-3">
    <!-- Paieška -->
    <div class="card my-4">
    <h5 class="card-header">Paieška</h5>
        <div class="card-body">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button">Ieškoti</button>
                </div>
            </div>
        </div>
    </div>
  
    <!-- Kategorijos -->
    <div class="card my-4">
        <h5 class="card-header">Etikečių debesis</h5>
        <div class="my-2 mx-3">
        <cms:pages masterpage='tags.php' custom_field='tool.php::tool_tags=ANY' >
            <a href="<cms:show k_page_link />">#<cms:show k_page_title /></a>
        </cms:pages>
        </div>
    </div>
</div>
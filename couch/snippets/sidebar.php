<div class="col-lg-3">
    <!-- Paieška -->
    <div class="card my-4">
    <h5 class="card-header">Paieška</h5>
        <div class="card-body">
            <cms:form method="post" name="search_tools" action="index.php" anchor='0'>
                <div class="input-group">
                    <cms:input name="search_input" type="text" class="form-control" autofocus required='1' />
                    <div class="input-group-append">
                        <cms:input class="btn btn-secondary" name="submit" type="submit" value="Ieškoti" />
                    </div>
                </div>
            </cms:form>
        </div>
    </div>
  
    <!-- Kategorijos -->
    <div class="card my-4">
        <h5 class="card-header">Etikečių debesis</h5>
        <div class="my-2 mx-3">
        <cms:capture into='tagCount'>
            <cms:pages masterpage='tags.php' custom_field='tool.php::tool_tags=ANY' count_only='1' />
        </cms:capture>
        <cms:if "<cms:show tagCount />">
            <cms:pages masterpage='tags.php' custom_field='tool.php::tool_tags=ANY'>
                <a href="<cms:add_querystring k_template_link "t=<cms:show k_page_name />" />" /><nobr>#<cms:show k_page_name /></nobr></a>
            </cms:pages>
        <cms:else />
            Panaudotų etikečių kol kas nėra
        </cms:if>
        </div>
    </div>
</div>
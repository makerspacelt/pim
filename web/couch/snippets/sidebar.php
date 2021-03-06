<div class="col-lg-3">
    <!-- Paieška -->
    <div class="card my-4">
    <h5 class="card-header">Paieška</h5>
        <div class="card-body">
            <cms:form method="post" name="search_tools" action="index.php#results" anchor='0'>
                <div class="input-group">
                    <cms:input name="search_input" type="text" class="form-control" autofocus="1" required='1' />
                    <div class="input-group-append">
                        <cms:input class="btn btn-secondary" name="submit" type="submit" value="Ieškoti" />
                    </div>
                </div>
            </cms:form>
        </div>
    </div>
  
    <!-- Kategorijos -->
    <div class="card my-4">
        <h5 class="card-header">Etiketės</h5>
        <div class="my-2 mx-3">
            <cms:set tagCount="<cms:pages masterpage='tags.php' custom_field='tool.php::tool_tags=ANY' count_only='1' />" />
            <cms:if tagCount>
                <cms:form method="post" name="filter_tools" action="tags.php#results" anchor='0'>
                    <cms:pages masterpage='tags.php' custom_field='tool.php::tool_tags=ANY'>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="<cms:show k_page_name />" name="tool_tags[]" value="<cms:show k_page_name />" />
                            <label class="custom-control-label" for="<cms:show k_page_name />">
                                <a href="<cms:add_querystring k_template_link "t=<cms:show k_page_name />" />#results"><nobr>#<cms:show k_page_name /></nobr></a>
                            </label>
                        </div>
                    </cms:pages>
                    <br/>
                    <cms:input class="btn btn-sm btn-block btn-secondary" name="submit" type="submit" value="Filtruoti" />
                </cms:form>
            <cms:else />
                Panaudotų etikečių kol kas nėra
            </cms:if>
        </div>
    </div>
</div>
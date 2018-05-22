<?php require_once( 'couch/cms.php' ); ?>
<cms:template name='tool_tags_template' title='Etiketės' clonable='1' order='2'>
    <cms:config_list_view exclude='default-page' searchable='1'>
        <cms:field 'k_selector_checkbox' />
        <cms:field 'k_page_title' sortable='0' />
        <cms:field 'k_actions' />
    </cms:config_list_view>
</cms:template>

<!--
    Tikrinam pirma ar filtruoja pagal pavienį tag'ą, priskiriam kintamajam
    su pridėtu filtravimo lauku 'tool_tags'.
-->
<cms:if "<cms:not_empty "<cms:gpc 't' default='' />" />">
    <cms:set arg="tool_tags=<cms:gpc 't' default='' />" />
<cms:else />
    <!--
        Tikrinam dabar ar filtruoja pagal kelis pasirinktus tag'us ir
        sukonstruojam filtravimo užklausą iš viso masyvo pridedant prie kiekvieno
        įrašo filtravimo lauką 'tool_tags'.
    -->
    <cms:if "<cms:not_empty "<cms:gpc 'tool_tags' default='' />" />">
        <cms:set arg="<cms:php>
            array_walk($_POST['tool_tags'], function(&$value, $key) { $value = 'tool_tags='.$value; });
            echo implode('|', $_POST['tool_tags']);
        </cms:php>" />
    <cms:else />
        <!-- Nukreipiam į pagrindinį jeigu tiesiog atėjo į puslapį be argumentų -->
        <cms:redirect url="<cms:link masterpage='index.php' />" />
    </cms:if>
</cms:if>

<cms:embed 'head.php' />
<cms:embed 'header.php' />
<div class="container">
    <div class="row">
    <cms:embed 'sidebar.php' />
        <div class="col-lg-9">
            <div class="row my-4">
                <cms:pages masterpage='tool.php' orderby='weight' order='asc' page_name='NOT default-page' custom_field="<cms:show arg />">
                    <cms:embed 'tool_card.php' />
                    <cms:no_results>
                        <cms:embed 'nieko_nerasta.php' />
                    </cms:no_results>
                </cms:pages>
            </div>
        </div>
    </div>
</div>
<cms:embed 'foot.php' />

<?php COUCH::invoke(); ?>
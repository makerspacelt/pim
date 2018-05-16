<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Įrankiai' clonable='1' order='1'>
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
        required='1'
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
        validator='non_negative_decimal'
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

<cms:if k_is_page ne '1'>
    <cms:redirect url="<cms:link masterpage='index.php' />" />
</cms:if>

<cms:embed 'head.php' />
<cms:embed 'header.php' />
<div class="container">
  <div class="row">
    <cms:embed 'sidebar.php' />

    <div class="col-lg-9">

      <div class="card mt-4">
        <cms:set toolImgCount="<cms:reverse_related_pages field='tool_img_gallery' masterpage='gallery.php' count_only='1' />" />
        <cms:if "<cms:show toolImgCount />">
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
            <img class="card-img-top img-fluid" src="images/default-tool-pic.png" alt="įrankio foto">
        </cms:if>
        <div class="card-body">
          <h3 class="card-title"><cms:show k_page_title /></h3>
          <h5 class="card-subtitle mb-3 text-muted"><cms:show tool_barcode /></h5>
          <p class="card-text"><cms:nl2br><cms:show tool_desc /></cms:nl2br></p>
          <p class="card-text">
            <cms:if "<cms:not_empty tool_shop_links />">
                <b>Kur galima įsigyti?</b><br/>
                <div class="tool-links">
                    <cms:php>
                        $urlArr = explode("\n", "<cms:show tool_shop_links />");
                        foreach ($urlArr as $url) {
                            if (preg_match('#(?xi)\b((?:https?://|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`\!()\[\]{};:\'".,<>?«»“”‘’]))#i', $url)) {
                                echo sprintf('<a href="%1$s" target="_blank">%1$s</a><br/>', $url);
                            } else {
                                echo $url.'<br/>';
                            }
                        }
                    </cms:php>
                </div>
            </cms:if>
          </p>
          <p class="card-text">
            <cms:if "<cms:not_empty tool_date />">
                Įsigyta <cms:show tool_date /><br/>
            </cms:if>
            <cms:if "<cms:not_empty tool_price />">
                Originali kaina <cms:show tool_price /> &euro;
            </cms:if>
          </p>
        </div>
      </div>
      <!-- /.card -->

      <div class="card card-outline-secondary my-4">
        <div class="card-header">Parametrai</div>
        <div class="card-body">
            <cms:set show_buffer='0' 'global' />
            <cms:capture into='tool_params_buffer'>
                <table class="table" style="margin-bottom: 0">
                    <thead>
                        <tr>
                            <th>Parametro vardas</th>
                            <th>Parametras</th>
                        </tr>
                    </thead>
                    <tbody>
                <cms:show_repeatable 'tool_params'>
                    <cms:if "<cms:not_empty tool_param_name />">
                        <cms:set show_buffer='1' 'global' />
                        <tr>
                            <td><cms:show tool_param_name /></td>
                            <td><cms:show tool_param_value /></td>
                        </tr>
                    </cms:if>
                </cms:show_repeatable>
                    </tbody>
                </table>
            </cms:capture>
            <cms:if show_buffer>
                <cms:show tool_params_buffer />
            <cms:else />
                Parametrų nėra
            </cms:if>
        </div>
      </div>
      
      <div class="card card-outline-secondary my-4">
        <div class="card-header">Atlikti priežiūros darbai</div>
        <div class="card-body">
          <cms:set show_buffer='0' 'global' />
          <cms:capture into='tool_service_log_buffer'>
            <cms:show_repeatable 'tool_service_log'>
                <cms:if "<cms:not_empty tool_service_job />">
                    <cms:set show_buffer='1' 'global' />
                    <p><cms:nl2br><cms:show tool_service_job /></cms:nl2br></p>
                    <cms:if k_count ne k_total_records>
                        <hr/>
                    </cms:if>
                </cms:if>
            </cms:show_repeatable>
          </cms:capture>
          <cms:if show_buffer>
              <cms:show tool_service_log_buffer />
          <cms:else />
              Įrankis dar netaisytas
          </cms:if>
        </div>
      </div>
      <!-- /.card -->

    </div>
    <!-- /.col-lg-9 -->

  </div>
</div>
<cms:embed 'foot.php' />
<?php COUCH::invoke(); ?>
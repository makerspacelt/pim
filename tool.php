<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Įrankiai' clonable='1' order='1'>
    <!---------------------------------------------------->
    <cms:config_list_view orderby='weight' order='asc' exclude='default-page' searchable='1'>
        <cms:field 'k_selector_checkbox' />
        <cms:field 'k_page_title' sortable='0' />
        <cms:field 'tool_model' header='Model' width='50' sortable='0' />
        <cms:field 'k_page_date' />
        <cms:field 'k_up_down' />
        <cms:field 'k_actions' />
        <cms:style>
            .col-title {
                width: 5%; important!
            }
            td.col-tool_model {
                font-weight: bold;
                color: #333;
            }
        </cms:style>
    </cms:config_list_view>
    <!---------------------------------------------------->
    <cms:editable
        name='tool_main_info_group'
        label='Pagrindinė informacija'
        type='group'
        collapsed='0'
        order='1'
    />
    
    <cms:config_form_view>
        <cms:field 'k_page_title' label='Įrankio pavadinimas' group='tool_main_info_group' order='1' />
        <cms:field 'k_page_name' label='Įrankio vidinis pavadinimas' desc='palikti tuščią kad naudoti sugeneruotą sistemos' group='tool_main_info_group' order='3' />
    </cms:config_form_view>
    
    <cms:editable
        name='tool_model'
        label='Modelis'
        type='text'
        order='2'
        group='tool_main_info_group'
    />
    
    <cms:editable
        name='tool_barcode'
        label='Barkodas'
        type='text'
        order='4'
        group='tool_main_info_group'>
        <cms:generate-code />
    </cms:editable>
    
    <cms:editable
        name='tool_desc'
        label='Aprašymas'
        type='textarea'
        required='1'
        validator_msg='required=Negali būti tuščias!'
        order='5'
        group='tool_main_info_group'
    />
    
    <cms:editable
        name='tool_photos'
        label='Nuotraukos'
        type='reverse_relation'
        masterpage='gallery.php'
        field='tool_img_gallery'
        anchor_text='Peržiūrėti nuotraukas'
        order='6'
        group='tool_main_info_group'
    />
    
    <cms:editable
        name='tool_tags'
        label='Etiketės'
        type='relation'
        masterpage='tags.php'
        order='7'
        group='tool_main_info_group'
    />
    <!---------------------------------------------------->
    <cms:editable
        name='tool_info_group'
        label='Papildoma informacija'
        type='group'
        collapsed='1'
        order='2'
    />
    
    <cms:editable
        name='tool_shop_links'
        label='Kur galima pirkti?'
        type='textarea'
        group='tool_info_group'
        order='1'
    />
    
    <cms:editable name='tool_aux_data_1' type='row' group='tool_info_group' order='2'>
        <cms:editable
            name='tool_price'
            label='Kaina'
            type='text'
            validator='non_negative_decimal'
            width='155'
            class='col'
        />
        <cms:editable
            name='tool_date'
            label='Įsigijimo data'
            desc='datos formatas: yyyy-mm-dd'
            type='text'
            validator='regex=#^\d{4}-\d{2}-\d{2}$#'
            validator_msg='regex=Netinkamas datos formatas!'
            width='155'
            class='col'
        />
    </cms:editable>
    <!---------------------------------------------------->
    <cms:editable
        name='tool_params_group'
        label='Parametrai'
        type='group'
        collapsed='1'
        order='3'
    />
    
    <cms:repeatable name='tool_params' label='&nbsp;' group='tool_params_group' order='1'>
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
    <!---------------------------------------------------->
    <cms:editable
        name='tool_service_log_group'
        label='Atlikti priežiūros darbai'
        type='group'
        collapsed='1'
        order='4'
    />
    <cms:repeatable name='tool_service_log' label='&nbsp;' group='tool_service_log_group' order='1'>
        <cms:editable
            name='tool_service_job'
            type='textarea'
        />
    </cms:repeatable>
    <!---------------------------------------------------->
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
          <h3 class="card-title"><cms:show k_page_title /> <cms:show tool_model /></h3>
          <h5 class="card-subtitle mb-3 text-muted"><cms:show tool_barcode /></h5>
          <p class="card-text"><cms:nl2br><cms:show tool_desc /></cms:nl2br></p>
          <p class="card-text">
            <cms:if "<cms:not_empty tool_shop_links />">
                <b>Kur galima įsigyti?</b><br/>
                <div class="tool-links">
                    <cms:url_detect>
                        <cms:nl2br><cms:show tool_shop_links /></cms:nl2br>
                    </cms:url_detect>
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
          <cms:if k_logged_in>
              <br/>
              <div class="card">
                <div class="card-header">
                    Lipduko generavimas
                </div>
                <div class="card-body">
                    <cms:capture into='queryStr'>
                        <cms:php>
                            $params = array();
                            <cms:show_repeatable 'tool_params'>
                                $params["<cms:show tool_param_name />"] = "<cms:show tool_param_value />";
                            </cms:show_repeatable>
                            $toolArr = array(
                                'title' => "<cms:show k_page_title />",
                                'model' => "<cms:show tool_model />",
                                'code' => "<cms:show tool_barcode />",
                                'url' => "<cms:show k_page_link />",
                                'params' => $params
                            );
                            echo http_build_query($toolArr);
                        </cms:php>
                    </cms:capture>
                    <img style="width:40%" src="label-generator/label.php?<cms:show queryStr />">
                </div>
              </div>
          </cms:if>
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
            <cms:show_repeatable 'tool_service_log' order='desc'>
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
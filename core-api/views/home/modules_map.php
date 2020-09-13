<section id="contact">
  <div class="c-content-box c-bg-img-top c-no-padding c-pos-relative">
    <div class="cbp-panelc" style="width:100%;">
        <div id="filters-container" class="cbp-l-filters-underline text-center">
            <div data-filter=".googlemap" class="cbp-filter-item-active cbp-filter-item c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-white c-btn-circle c-btn-uppercase c-btn-sbold"> <?=$word->wordvar('GOOGLE MAP');?> </div>
            <div data-filter=".photomap" class="cbp-filter-item c-btn-border-opacity-04 c-btn btn-no-focus c-btn-header btn btn-sm c-btn-border-1x c-btn-white c-btn-circle c-btn-uppercase c-btn-sbold"> <?=$word->wordvar('PHOTO MAP');?> </div>
        </div>

        <div id="grid-container" class="cbp cbp-l-grid-faq">
            <div class="cbp-item googlemap">
                <div class="cbp-caption" id="map">

                </div>
            </div>
            <div class="cbp-item photomap">
                <div class="cbp-caption" style="text-align: center;background-color: #453535;">
                    <img src="<?="{$url}/images/".getcontact('contact_photomap');?>" class="img-responsive" style="margin:0 auto;" />
                </div>
            </div>

        </div>
    </div>
  </div>
</section>
<style type="text/css">
  #map{
    margin: auto;
    width: 100%;
    height: auto;
    min-height: 500px;
    background: #333;
  }
  .cbp img{
    width: auto !important;
  }
</style>

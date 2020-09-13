<div class="c-content-box c-size-md" style="padding:0px;">
  <div class="container" style="background-color:#eed6ca;">
    <div class="row">
      <div class="col-md-3" style="padding-top:40px;padding-bottom:40px;">
        <!-- BEGIN: SIDEBAR -->
        <div class="c-content-ver-nav menu_scroll">
          <ul class="c-menu c-arrow-dot1 c-theme">
            <li><a href="about-us"><?=$word->wordvar('About us');?></a></li>
            <li><a href="vision"><?=$word->wordvar('Vision');?></a></li>
            <li><a href="board"><?=$word->wordvar('Board');?></a></li>
            <li><a href="supervision"><?=$word->wordvar('Supervision');?></a></li>
            <li><a href="past-projects"><?=$word->wordvar('Past projects');?></a></li>
          </ul>
        </div>
        <!-- END: SIDEBAR -->
      </div>
      <div class="col-md-9" style="background-color:#fff;padding-top:40px;">
        <div class="c-content-blog-post-1-view" style="padding-right:0px;">
          <div class="c-content-blog-post-1 wow animated fadeIn" id="about-us" data-scroll="about-us">
            <div class="c-title c-font-bold c-font-uppercase c-center">
              <?=$model->getData('pagename','About-us');?>
              <div class="c-line-center"></div>
            </div>
            <div class="c-desc">
              <?=$model->getData('pageimg','About-us');?>
            </div>
            <div class="c-desc">
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <?=$model->getData('pagedetail','About-us');?>
                </div>
              </div>
            </div>
          </div>
          <div class="c-content-blog-post-1 wow animated fadeIn" >
            <div class="c-title c-font-bold c-font-uppercase">
              <?=$model->getData('pagename','The-path-to-sustainability');?>
              <div class="c-line-center"></div>
            </div>
            <div class="c-desc">
              <?=$model->getData('pageimg','The-path-to-sustainability');?>
            </div>
            <div class="c-desc">
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <?=$model->getData('pagedetail','The-path-to-sustainability');?>
                </div>
              </div>
            </div>
          </div>
          <div class="c-content-blog-post-1 wow animated fadeIn" id="vision" data-scroll="vision">
            <div class="c-title c-font-bold c-font-uppercase">
              <?=$model->getData('pagename','Vision');?>
              <div class="c-line-center"></div>
            </div>
            <div class="c-desc">
              <div class="row">
                <div class="col-md-6">
                  <?=$model->getData('pagedetail','Vision');?>
                </div>
                <div class="col-md-6">
                  <?=$model->getData('pageimg','Vision');?>
                </div>
              </div>
            </div>

          </div>

          <div class="c-content-blog-post-1 wow animated fadeIn" id="board" data-scroll="board">
            <div class="c-title c-font-bold c-font-uppercase c-center">
              <?=$word->wordvar('Board');?>
              <div class="c-line-center"></div>
            </div>
            <div class="c-desc">
              <div class="row">
                <?php echo $model->lastTeam();?>
              </div>
            </div>
          </div>

          <div class="c-content-blog-post-1 wow animated fadeIn" id="supervision" data-scroll="supervision">
            <div class="c-title c-font-bold c-font-uppercase">
              <?=$model->getData('pagename','Supervision');?>
              <div class="c-line-center"></div>
            </div>
            <div class="c-desc">
              <?=$model->getData('pagedetail','Supervision');?>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>
<!-- begin past projects -->
<div class="c-content-box c-size-md c-bg-grey-1" >

  <div class="container">
    <div class="col-md-12">
      <div class="c-content-blog-post-1 wow animated fadeIn" style="margin-bottom:50px;" id="past-projects" data-scroll="past-projects">
        <div class="c-title c-font-bold c-font-uppercase">
          <?=$word->wordvar('Past projects');?>
          <div class="c-line-center"></div>
        </div>
        <div class="c-content-person-1-slider" data-slider="owl">
          <div class="owl-carousel owl-theme c-theme c-owl-nav-center wow animated fadeInUp" data-items="3" data-slide-speed="8000" data-rtl="false">
            <?php echo $model->listProjects();?>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- end past projects -->

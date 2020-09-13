<div class="br-sideright">
  <ul class="nav nav-tabs sidebar-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" role="tab" href="#contacts"><i class="icon ion-ios-contact-outline tx-24"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" role="tab" href="#calendar"><i class="icon ion-ios-calendar-outline tx-24"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" role="tab" href="#settings"><i class="icon ion-ios-gear-outline tx-24"></i></a>
    </li>
  </ul><!-- sidebar-tabs -->

  <!-- Tab panes -->
  <div class="tab-content">
    <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto active" id="contacts" role="tabpanel">
      <label class="sidebar-label pd-x-25 mg-t-25">Users Online</label>
      <div class="contact-list pd-x-10" id="div_useronline">

      </div><!-- contact-list -->


      <label class="sidebar-label pd-x-25 mg-t-25">Users Offline</label>
      <div class="contact-list pd-x-10" id="div_useroffline">

      </div><!-- contact-list -->

    </div><!-- #contacts -->
    <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="calendar" role="tabpanel">
      <label class="sidebar-label pd-x-25 mg-t-25">Time &amp; Date</label>
      <div class="pd-x-25">
        <h2 id="brTime" class="tx-white tx-lato mg-b-5"></h2>
        <h6 id="brDate" class="tx-white tx-light op-3"></h6>
      </div>

      <label class="sidebar-label pd-x-25 mg-t-25">Events Calendar</label>
      <div class="datepicker sidebar-datepicker"></div>

    </div>
    <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="settings" role="tabpanel">
      <label class="sidebar-label pd-x-25 mg-t-25">Quick Settings</label>

      <!-- <div class="pd-y-20 pd-x-25 tx-white">
        <h6 class="tx-13 tx-normal">Sound Notification</h6>
        <p class="op-5 tx-13">Play an alert sound everytime there is a new notification.</p>
        <div class="pos-relative">
          <input type="checkbox" name="checkbox" class="switch-button" checked>
        </div>
      </div> -->

    </div>
  </div><!-- tab-content -->
</div><!-- br-sideright -->

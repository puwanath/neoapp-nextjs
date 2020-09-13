<div class="br-header">
  <div class="br-header-left">
    <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a></div>
    <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i class="icon ion-navicon-round"></i></a></div>
  </div><!-- br-header-left -->
  <div class="br-header-right">
    <nav class="nav">
      <div class="dropdown">
        <a href="" class="nav-link pd-x-7 pos-relative btnshownotifi" data-toggle="dropdown">
          <i class="icon ion-ios-bell-outline tx-24"></i>
          <!-- start: if statement -->
          <span class="square-8 bg-danger pos-absolute t-15 r-5 rounded-circle"></span>
          <!-- end: if statement -->
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-300 pd-0-force">
          <div class="d-flex align-items-center justify-content-between pd-y-10 pd-x-20 bd-b bd-gray-200">
            <label class="tx-12 tx-info tx-uppercase tx-semibold tx-spacing-2 mg-b-0">Notifications</label>
            <!-- <a href="" class="tx-11">Mark All as Read</a> -->
          </div><!-- d-flex -->

          <div class="media-list" id="div_shownotify">
            <!-- loop starts here -->
          </div><!-- media-list -->
        </div><!-- dropdown-menu -->
      </div><!-- dropdown -->
      <div class="dropdown">
        <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
          <span class="logged-name hidden-md-down"><?=$userfullname;?></span>
          <img src="<?=$userimg;?>" style="height:32px;width:32px;" class="wd-32 rounded-circle" alt="">
          <span class="square-10 bg-success"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-200">
          <ul class="list-unstyled user-profile-nav">
            <li><a href="<?=$url;?>/setting/profile/<?=$userfullname;?>"><i class="icon ion-ios-person"></i> แก้ไขโปรไฟล์</a></li>
            <li><a href="?logout"><i class="icon ion-power"></i> ออกจากระบบ</a></li>
          </ul>
        </div><!-- dropdown-menu -->
      </div><!-- dropdown -->
    </nav>
    <div class="navicon-right">
      <a id="btnRightMenu" href="#" class="pos-relative">
        <i class="icon ion-ios-chatboxes-outline"></i>
        <!-- start: if statement -->
        <span class="square-8 bg-danger pos-absolute t-10 r--5 rounded-circle"></span>
        <!-- end: if statement -->
      </a>
    </div><!-- navicon-right -->
  </div><!-- br-header-right -->
</div><!-- br-header -->

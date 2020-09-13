<div class="br-logo"><a href="<?=$url;?>"><span>[</span>eControl<span>] V7.0</span></a></div>
<div class="br-sideleft overflow-y-auto">
  <label class="sidebar-label pd-x-15 mg-t-20">Navigation</label>
  <div class="br-sideleft-menu">
    <a href="<?=$url;?>" class="br-menu-link <?php if($get_part0=='' or $get_part0=='welcome'){ echo "active";}else{ echo "";}?>">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
        <span class="menu-item-label">Dashboard</span>
      </div>
    </a>
    <?php echo implode('',getMenu_permission($get_part0,$get_part1,$get_part2));?>


  </div><!-- br-sideleft-menu -->


  <br>
</div><!-- br-sideleft -->

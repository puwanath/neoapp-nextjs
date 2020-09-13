<?php
function getMenu_permission(){
  include('common/include/config.php');
  $arr = array();

  $sessionuser = getSession();
  $sqluser = "select * from kp_users where user_id = '$sessionuser' and status =1 ";
  $quser = $dbCon->query($sqluser) or die($dbCon->error);
  $resuser = $quser->fetch_object();
  $levelcode = $resuser->user_level;

  $url = curPageURL();
  $sql = "select * from kp_menu where menu_main_id = '' and
  menu_id in (select menu_id from kp_user_permission where level_id = '$levelcode' and permis_show =1)
  order by menu_id,menu_main_id asc";
  $qr = $dbCon->query($sql) or die($dbCon->error);
  while($res = $qr->fetch_object()){

    // $sqlpermission = "select * from kp_user_permission where level_id = '$levelcode' and menu_id = '$res->menu_id' ";
    // $qpermission = $dbCon->query($sqlpermission) or die($dbCon->error);
    // $respermission = $qpermission->fetch_object();

    // if($respermission->permis_show==1):

    if($res->menu_type==1){
      $data = "<li class=\"dropdown site-menu-item has-sub\">
        <a href=\"$url/$res->menu_part\">
          <i class=\"$res->menu_fa\" aria-hidden=\"true\"></i>
          <span class=\"site-menu-title\">$res->menu_name</span>
        </a>
      </li>";
    }else{
        $arrsub = array();
        $sqlsub = "select * from kp_menu where menu_main_id = '$res->menu_id' and
        menu_id in (select menu_id from kp_user_permission where level_id = '$levelcode' and permis_show =1)
        order by menu_id,menu_main_id asc";
        $qrsub = $dbCon->query($sqlsub) or die($dbCon->error);
        while($ressub = $qrsub->fetch_object()){
          $submenu = "<li class=\"site-menu-item\">
            <a class=\"animsition-link\" href=\"$url/$ressub->menu_part\">
              <span class=\"site-menu-title\">$ressub->menu_name</span>
            </a>
          </li>";
          array_push($arrsub,$submenu);
        }

        $data = "<li class=\"dropdown site-menu-item has-sub\">
          <a data-toggle=\"dropdown\" href=\"javascript:void(0)\" data-dropdown-toggle=\"false\">
            <i class=\"$res->menu_fa\" aria-hidden=\"true\"></i>
            <span class=\"site-menu-title\">$res->menu_name</span>
            <span class=\"site-menu-arrow\"></span>
          </a>
          <div class=\"dropdown-menu\">
            <div class=\"site-menu-scroll-wrap is-list\">
              <div>
                <div>
                  <ul class=\"site-menu-sub site-menu-normal-list\">";
                  $data.= implode('',$arrsub);
          $data.="</ul>
                </div>
              </div>
            </div>
          </div>
        </li>";


    }

    array_push($arr,$data);

  // endif; // end check permission menu show
  }

  return $arr;

}



?>

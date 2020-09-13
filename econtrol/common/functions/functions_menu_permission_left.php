<?php
function getMenu_permission($gp0,$gp1,$gp2){
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
      if($gp0==$res->menu_part){
        $active = "active";
      }else{
        $active = "";
      }


      $data = "<a href=\"$url/$res->menu_part\" class=\"br-menu-link $active\">";
      $data.= "<div class=\"br-menu-item\">";
      $data.= "<i class=\"menu-item-icon icon $res->menu_fa tx-22\"></i>";
      $data.= "<span class=\"menu-item-label\">$res->menu_name</span>";
      $data.= "</div>";
      $data.= "</a>";


    }else{
        $arrsub = array();
        $sqlsub = "select * from kp_menu where menu_main_id = '$res->menu_id' and
        menu_id in (select menu_id from kp_user_permission where level_id = '$levelcode' and permis_show =1)
        order by menu_id,menu_main_id asc";
        $qrsub = $dbCon->query($sqlsub) or die($dbCon->error);
        while($ressub = $qrsub->fetch_object()){
          if($gp0==$ressub->menu_part){
            $active = "active";
          }else{
            $active = "";
          }

          $submenu = "<li class=\"nav-item\"><a href=\"$url/$ressub->menu_part\" class=\"nav-link $active\">$ressub->menu_name</a></li>";

          // $submenu = "<li class=\"m-menu__item m-menu__item--$active\" aria-haspopup=\"true\" >";
          // $submenu.= "<a  href=\"$url/$ressub->menu_part\" class=\"m-menu__link \">";
          // $submenu.= "<i class=\"m-menu__link-bullet m-menu__link-bullet--dot\"><span></span></i>";
          // $submenu.= "<span class=\"m-menu__link-text\"> $ressub->menu_name </span>";
          // $submenu.= "</a>";
          // $submenu.= "</li>";


          array_push($arrsub,$submenu);
        }
        if($gp0!='' and $gp1!='' and ($gp1!='add' and $gp1!='edit')){
          $mixgp = $gp0.'/'.$gp1;
          $activemenu = $dbCon->query("select * from kp_menu where menu_part = '".$mixgp."' ") or die($dbCon->error);
        }else{
          $activemenu = $dbCon->query("select * from kp_menu where menu_part = '".$gp0."' ") or die($dbCon->error);
        }
        $resat = $activemenu->fetch_object();
        $num = $activemenu->num_rows;
        if($resat->menu_main_id==$res->menu_id){
          $active = "active show-sub";
        // }elseif($resat->menu_main_id==$resat->menu_id){
        //   $active = "--active";
        }else{
          $active = "";
        }

        $data = "<a href=\"#\" class=\"br-menu-link $active\">";
        $data.= "<div class=\"br-menu-item\">";
        $data.= "<i class=\"menu-item-icon icon $res->menu_fa tx-22\"></i>";
        $data.= "<span class=\"menu-item-label\"> $res->menu_name</span>";
        $data.= "<i class=\"menu-item-arrow fa fa-angle-down\"></i>";
        $data.= "</div>";
        $data.= "</a>";
        $data.= "<ul class=\"br-menu-sub nav flex-column\">";
        $data.= implode('',$arrsub);
        $data.= "</ul>";

    }

    array_push($arr,$data);

  // endif; // end check permission menu show
  }

  return $arr;

}

function getMenu_permission_button($arrmenu){
  include('common/include/config.php');
  $arr = array();
  $path_info = parse_path();
  $getpart0 = $path_info['call_parts'][0];
  $getpart1 = $path_info['call_parts'][1];
  if($getpart1){
    $mixpart = $getpart0.'/'.$getpart1;
  }else{
    $mixpart = $getpart0;
  }

  $sessionuser = getSession();
  $sqluser = "select * from kp_users where user_id = '$sessionuser' and status =1 ";
  $quser = $dbCon->query($sqluser) or die($dbCon->error);
  $resuser = $quser->fetch_object();
  $levelcode = $resuser->user_level;

  foreach ($arrmenu as $key => $value) {
    $sql = "select * from kp_user_permission where menu_id in
    (select menu_id from kp_menu where menu_part='$mixpart') and level_id = '$levelcode' ";
    $qr = $dbCon->query($sql) or die($dbCon->error);
    $res = $qr->fetch_object();
    if($res->permis_add==1 and $key=="add"){
      $btn = $value;
      array_push($arr,$btn);
    }elseif($res->permis_edit==1 and $key=="edit"){
      $btn = $value;
      array_push($arr,$btn);
    }elseif($res->permis_del==1 and $key=="del"){
      $btn = $value;
      array_push($arr,$btn);
    }elseif($res->permis_cf==1 and $key=="confirm"){
      $btn = $value;
      array_push($arr,$btn);
    }elseif($res->permis_show==1 and $key=="show"){
      $btn = $value;
      array_push($arr,$btn);
    }

  }


  return implode('',$arr);
}


?>

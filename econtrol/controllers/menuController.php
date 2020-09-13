<?php
$param = "menu";
require "models/$param.php";

class menuController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "จัดการเมนู";
		$param = "menu";
		$model = new menuController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'loaddata' :
				 $model->loadData();
				 break;

			case 'readdata' :
				 $model->readData();
				 break;

			case 'add' :
				 $model->addData();
				 break;

			case 'update' :
				 $model->updateData();
				 break;

			case 'del' :
				 $model->delData();
				 break;

			case 'loadmenu' :
				 $model->loadMenu();
				 break;


			default :
			$urlredirec = "../welcome";
			echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$urlredirec.'">';
			exit();
		}

		endif;

		$user = getSession();
		$qruser = $this->fetchdata("kp_users","where user_id = '$user' ");
		$re = $qruser->fetch_object();
		$userid = $re->user_id;
		$userfullname = $re->user_fullname.' '.$re->user_lastname;
		if($re->user_avatar!=''){
			$userimg = $re->user_avatar;
		}else{
			$userimg = "avatar.png";
		}


		$qr = $this->fetchdata("kp_user_level","where level_id = '".$re->user_level."' ");
		$res = $qr->fetch_object();

		$levelname = $res->level_name;


		if($select==''){
			$content = "views/$param/index.php";
			$page = include("views/layout/template.php");
			return $page;
		}


	}
	//end function page

	public function loadData()
	{
		$rows = array();
		$qr = $this->fetchdata("kp_menu","where 1 order by menu_id,menu_main_id asc");
		$num = $qr->num_rows;
		if($num>0):
		while($res = $qr->fetch_object()){

				$id = $res->menu_id;
				//$menuname = $res->menu_name;

				$btnedit = "<a data-id=\"row-' . $id .'\" href=\"javascript:editRow('$id');\" class=\"btn btn-xs btn-icon btn-warning btn-outline\"><i class=\"icon wb-wrench\"></i></a>";
				$btndel = "<a href=\"javascript:removeRow('$id','$res->menu_name');\" class=\"btn btn-xs btn-icon btn-danger btn-outline\"><i class=\"icon wb-trash\"></i></a>";
				// if($res->status==1){
				// 	$status = "<button class='btn btn-success btn-xs'>Active</button>";
				// }else{
				// 	$status = "<button class='btn btn-danger btn-xs'>inActive</button>";
				// }

				if($res->menu_type==1){
					$menutype = "เมนูแบบเดี่ยว";
				}else{
					$menutype = "เมนูแบบกลุ่ม";
				}

				if($res->menu_main_id!=''){
					$menuname = "-- <i style='color:#999;'>".$res->menu_name."</i>";
				}else{
					$menuname = "<font color='#000'><b>".$res->menu_name."</b></font>";
				}

				$i++;
				$rows[line] = $i;
				$rows[menuname] = $dat.$menuname;
				//$rows[menugroup] = $dat.$this->getmenuName($res->menu_main_id);
				$rows[menutype] = $menutype;
				$rows[act] = $btnedit." ".$btndel;
				$output['data'][] = $rows;

		}
	else:
		$rows[line] = null;
		$rows[menuname] = null;
		//$rows[menugroup] = null;
		$rows[menutype] = null;
		$rows[act] = null;

		$output['data'][] = $rows;

	endif;


		echo json_encode($output);
	}


	public function getmenuName($id){
		$qr = $this->fetchdata("kp_menu","where menu_id = '$id' ");
		$res = $qr->fetch_object();

		return $res->menu_name;
	}


	public function loadMenu(){
		$url = curPageURL();
		$id = $_REQUEST['id'];

		$arr = array();
		$qr = $this->fetchdata("kp_menu","where 1 order by menu_id desc ");
		while($res = $qr->fetch_object()){

			$arr['id'] = $res->menu_id;
			$arr['name']= $res->menu_name;

			$respon['datarow'][] = $arr;
		}
		echo json_encode($respon);

	}


	public function readData()
	{
		$url = curPageURL();
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_menu","where menu_id = '$id' ");
		$res = $qr->fetch_object();


		$rows = array(
			'id'=>$res->menu_id,
			'menuname'=>$res->menu_name,
			'menupart'=>$res->menu_part,
			'menufa'=>$res->menu_fa,
			'menumain'=>$res->menu_main_id,
			'menuseg'=>$res->menu_seg,
			'menutype'=>$res->menu_type

		);

		echo json_encode($rows);
	}

	//begin function addData
	public function addData()
	{
		$menuname = $_REQUEST['txtname'];
		$menupart = $_REQUEST['txtpart'];
		$menufa = $_REQUEST['txticon'];
		$menugroup = $_REQUEST['txtgroup'];
		$menutype = $_REQUEST['txttype'];
		$usercreate = getSession();


		if(isset($_REQUEST['txtname'])):

			$form_data = array(
				'menu_name'=>$menuname,
				'menu_part'=>$menupart,
				'menu_fa'=>$menufa,
				'menu_main_id'=>$menugroup,
				'menu_seg'=>0,
				'menu_type'=>$menutype
			);

			$insert = $this->insertrow('kp_menu',$form_data);

			//start function save log transection
			$desclog = "เพิ่ม เมนู  ชื่อ $menuname";
			savelog(getSession(),$desclog);
			//end function save log transection

		endif;

		if($insert){
			$jsonstatus = "success";
			$jsonrespontext = "Add Menu success!";
			$jsonmsg = "เพิ่มเมนู สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Add Menu error!";
			$jsonmsg = "ไม่สามารถ เพิ่มเมนู สำเร็จ  กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","msg"=>"$jsonmsg");
		echo json_encode($respon);
	}

	//end function addData

	//begin function addData
	public function updateData()
	{
		$id = $_REQUEST['id'];
		$menuname = $_REQUEST['txtname'];
		$menupart = $_REQUEST['txtpart'];
		$menufa = $_REQUEST['txticon'];
		$menugroup = $_REQUEST['txtgroup'];
		$menutype = $_REQUEST['txttype'];
		$usercreate = getSession();

		if(isset($_REQUEST['txtname'])):

			$form_data = array(
				'menu_name'=>$menuname,
				'menu_part'=>$menupart,
				'menu_fa'=>$menufa,
				'menu_main_id'=>$menugroup,
				'menu_seg'=>0,
				'menu_type'=>$menutype
			);

			$update = $this->updaterow('kp_menu', $form_data, "WHERE menu_id = '$id'");

		endif;


		if($update){
			$jsonstatus = "success";
			$jsonrespontext = "Update Menu success!";
			$jsonmsg = "แก้ไข เมนู สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Update Menu error!";
			$jsonmsg = "ไม่สามารถ แก้ไขเมนู สำเร็จ  กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","respontext"=>$jsonrespontext,"msg"=>"$jsonmsg");
		echo json_encode($respon);
	}

	//end function addData

	//begin function addData
	public function delData()
	{
		$id = $_REQUEST['id'];


		if(isset($id)):
		$del = $this->delrow("kp_menu","where menu_id = '$id' ");
		endif;

		if($update){
			$jsonstatus = "success";
			$jsonrespontext = "Delete Menu success!";
			$jsonmsg = "ลบ เมนู สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Delete Menu error!";
			$jsonmsg = "ไม่สามารถ ลบ เมนู สำเร็จ  กรุณาติดต่อ Support";
		}

		$respon = array('status'=>$jsonstatus,'respontext'=>$jsonrespontext,'msg'=>$jsonmsg);
		echo json_encode($respon);
	}

	//end function addData

}

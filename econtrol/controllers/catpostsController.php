<?php
$param = "catposts";
require "models/$param.php";

class catpostsController extends Controllers
{
	public function index($get_part0,$get_part1,$get_part2){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagename = "จัดการหมวดหมู่บทความบทความ";
		$param = "catposts";
		$model = new catpostsController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'readdata' :
				$model->readdata();
				break;

			case 'add' :
				$model->addData();
				break;

			case 'loaddata' :
				$model->loadData();
				break;

			case 'update' :
				 $model->updateData();
				 break;

			case 'del' :
				 $model->delData();
				 break;

 		  case 'sortrow' :
 			   $model->sortRow();
 			   break;

		  case 'isstatus' :
		  	 $model->changeIsstatus();
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
		$userfullname = $re->fullname;
		if($re->user_avatar!=''){
			$userimg = $url.'/images/user/tmp/'.$re->user_avatar;
		}else{
			$userimg = $url.'/images/avatar.jpg';
		}

		// permission mwnu
		$mainmenu = array(
			'add'=>'<a href="javascript:;" id="addform" class="btn btn-primary btn-with-icon"><div class="ht-40"><span class="icon wd-40"><i class="fa fa-plus"></i></span><span class="pd-x-15">เพิ่มหมวดหมู่บทความ</span></div></a>'
		);
		// permission mwnu

		// begin css and js
		$cssarr = array(
			"<link href='".$dir."lib/select2/css/select2.min.css' rel='stylesheet'>",
			"<link rel='stylesheet' type='text/css' media='screen' href='".$dir."jqGrid/css/trirand/ui.jqgrid-bootstrap4.css' />",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/i18n/grid.locale-th.js'></script>",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/jquery.jqGrid.min.js'></script>"
		);

		$jsarr = array(
			"<script src='".$dir."lib/select2/js/select2.min.js'></script>",
		);
		//end css and js script


		if($select==''){
			$content = "views/$param/index.php";
			$page = include("views/layout/template.php");
			return $page;
		}

	}

	public function readdata(){

		$id = $_REQUEST['id'];

		$output = array();
		$qr = $this->fetchdata("kp_cat_post","WHERE cat_id = '$id' ");
		$res = $qr->fetch_object();

		$output['id'] = $res->cat_id;
		$output['slug'] = $res->slug;
		$output['cat_name_th'] = $res->cat_name_th;
		$output['cat_name_en'] = $res->cat_name_en;
		$output['status'] = $res->status;

		echo json_encode($output);
	}

	public function loadData(){
		$arr = array();
		$urlweb = curPageURLWeb();
		include "common/include/config.php";
		$requestData= $_REQUEST;

		$page = $requestData["page"];
		$limit = $requestData["rows"];
		$sidx = $requestData["sidx"];
		$sord = $requestData["sord"];
		if (!$sidx) $sidx = 1;
		$totalrows = isset($requestData["totalrows"]) ? $requestData["totalrows"]: false;
		if($totalrows) {
				$limit = $totalrows;
		}

		$sql = "select count(*) as countrow from kp_cat_post where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( cat_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR lower(cat_name_en) LIKE lower('%".$requestData['search']."%') )";
		}
		$res = $dbCon->query($sql)->fetch_assoc();
		$count = $res['countrow'];

		if ($count > 0 ) {
				$var = @($count/$limit);
				$totalpages = ceil ($var);
		} else {
				$totalpages = 0;
		}

		if ($page > $totalpages) $page=$totalpages;
		if ($limit < 0) $limit = 0;

		$start = $limit*$page - $limit;
		if ($start < 0) $start = 0;

		$sql = "select * from kp_cat_post where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( cat_name_th LIKE '%".$requestData['search']."%' ";
			$sql.= "OR lower(cat_name_en) LIKE lower('%".$requestData['search']."%') )";
		}
		if( !empty($sidx) ) {
			$sql.= "order by $sidx $sord ";
		}

		if( !empty($start) ) {
			$sql.= "limit $start , $limit ";
		}
		$i = 0;
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$cat_id = $res->cat_id;
			$cat_name_th = $res->cat_name_th;
			$cat_name_en = $res->cat_name_en;
			$slug = $res->slug;
			$sortnum = $res->sort;
			$created = date("d/m/Y H:i:s",strtotime($res->create_date));

			if($res->status==1){
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('0','$cat_id')\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-check\"></i></button>";
			}else{
				$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('1','$cat_id')\" class=\"btn btn-sm btn-secondary\"><i class=\"fa fa-check\"></i></button>";
			}

			$btn_sort = "<button type=\"button\" onclick=\"sortRow('$sortnum','up');\" class=\"btn btn-sm btn-light\"><i class=\"fa fa-sort-up\"></i></button>";
			$btn_sort.= "<button type=\"button\" onclick=\"sortRow('$sortnum','down');\" class=\"btn btn-sm btn-light\"><i class=\"fa fa-sort-down\"></i></button>";

			$btn_act = array(
				"edit"=>"<button type=\"button\" onclick=\"editRow('$cat_id');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>"<button type=\"button\" onclick=\"delFunc('$cat_id','$cat_name_th');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_status.$btn_sort.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$i++;
			$row = array();
			$row['id'] = $cat_id;
			$row['row'] = $i;
			$row['cat_name_th'] = $cat_name_th;
			$row['cat_name_en'] = $cat_name_en;
			$row['slug'] = $slug;
			$row['created'] = $created;
			$row['btn_act'] = $btnaction;
			$arr[] = $row;
		}
		$output = array();
		$output['records'] = $count;
		$output['page'] = $page;
		$output['total'] = ceil($count/$limit);
		$output['rows'] = $arr;

		echo json_encode($output);
	}

	public function addData(){
		$slug = str_replace(' ','-',$_POST['slug']);
		$cat_name_th = $_POST['cat_name_th'];
		$cat_name_en = $_POST['cat_name_en'];
		$sortnum = $this->sortMax('kp_cat_post','sort');
		$status = 1;
		$is_delete = 0;

		if($cat_name_th):

			$form_data = array(
				'slug'=>$slug,
				'cat_name_th'=>$cat_name_th,
				'cat_name_en'=>$cat_name_en,
				'sort'=>$sortnum,
				'status'=>$status,
				'is_delete'=>$is_delete
			);

			$insert = $this->insertrow('kp_cat_post',$form_data);

		endif;

		if($insert){
			//start function save log transection
			$desclog = "เพิ่ม หมวดหมู่บทความ $cat_name_th/$cat_name_en";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Add $cat_name_th success!";

		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Add $cat_name_th error!";
		}
		echo json_encode($respon);
	}


	public function updateData(){
		$id = $_POST['id'];
		$slug = str_replace(' ','-',$_POST['slug']);
		$cat_name_th = $_POST['cat_name_th'];
		$cat_name_en = $_POST['cat_name_en'];

		if($cat_name_th):

		$form_data = array(
			'slug'=>$slug,
			'cat_name_th'=>$cat_name_th,
			'cat_name_en'=>$cat_name_en
		);

		$update = $this->updaterow('kp_cat_post',$form_data,"where cat_id = '$id' ");

		endif;

		if($update){
			//start function save log transection
			$desclog = "อัพเดท หมวดหมู่บทความ $cat_name_th/$cat_name_en";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "Update $cat_name_th success!";
		}else{

			$respon['status'] = "error";
			$respon['msg'] = "Update $cat_name_th error!";
		}
		echo json_encode($respon);
	}

	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_cat_post","where cat_id = '$id' ");
		$res= $qr->fetch_object();
		$cat_name_th = $res->cat_name_th;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_cat_post",array('is_delete'=>'1'),"where cat_id = '$id' ");
		endif;

		if($del){

			//start function save log transection
			$desclog = "ลบ [ หมวดหมู่บทความ ] ชื่อ $cat_name_th";
			savelog(getSession(),$desclog);
			//end function save log transection

			$this->sortDatanew();

			$respon['status'] = "success";
			$respon['msg'] = "Delete $cat_name_th success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "Delete $cat_name_th error!";
		}

		echo json_encode($respon);
	}
	//end function delData

	public function sortDatanew(){
		$qr = $this->fetchdata("kp_cat_post","order by sort asc");
		while($res = $qr->fetch_object()){
			$id = $res->cat_id;
			$arrid[] = $id;
		}

		$i = 0;
		foreach ($arrid as $value) {
			$cat_id = $value;
			$data = array('sort'=>$i);
			$this->updaterow("kp_cat_post",$data,"where cat_id = '".$cat_id."' ");
			//echo "<br/>$i<br/>";
			$i++;

		}
	}

	public function sortRow(){
		$sorttype = $_REQUEST['type'];
		$output = array();
		if($_REQUEST['line']==0 and $sorttype=="up"){
			$output['status'] = "error";
			$output['msg'] = "รายการที่จัดเรียง ของคุณอยู่อันดับบนสุดแล้ว!";
		}elseif($_REQUEST['line']==($this->countdatasort("sort","kp_cat_post")-1) and $sorttype=="down"){
			$output['status'] = "error";
			$output['msg'] = "รายการที่จัดเรียง ของคุณอยู่อันดับสุดท้ายแล้ว!";
		}else{
			$output['status'] = "success";
			if($sorttype=="up"){
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$sortline = $this->fetchdata("kp_cat_post","where sort = '$sort' ");
				$resline = $sortline->fetch_object();

				$sortline2 = $this->fetchdata("kp_cat_post","where sort = '$sort_post' ");
				$resline2 = $sortline2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_post
				);

				$this->updaterow("kp_cat_post",$sortdata,"where cat_id = '".$resline->cat_id."' ");
				// echo "track = $track\n";
				// echo "track_sort = $tracksort_post\n";
				// echo "track_id = $restrack->track_id\n";
				// echo "================================\n";
				// =======================================================================


				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_cat_post",$sortdata2,"where cat_id = '".$resline2->cat_id."' ");
				// echo "track = $tracksort_post\n";
				// echo "track_sort = $track\n";
				// echo "track_id = $restrack2->track_id\n";
				// echo "================================\n";
			}else{
				$sort = $_REQUEST['line'];
				$sort_plus = $sort+1;
				$sort_post = $sort-1;
				$sortline = $this->fetchdata("kp_cat_post","where sort = '$sort' ");
				$resline = $sortline->fetch_object();

				$sortline2 = $this->fetchdata("kp_cat_post","where sort = '$sort_plus' ");
				$resline2 = $sortline2->fetch_object();

				$sortdata = array(
					'sort'=>$sort_plus
				);

				$this->updaterow("kp_cat_post",$sortdata,"where cat_id = '".$resline->cat_id."' ");
				// =======================================================================

				$sortdata2 = array(
					'sort'=>$sort
				);

				$this->updaterow("kp_cat_post",$sortdata2,"where cat_id = '".$resline2->cat_id."' ");
			}
		}

		echo json_encode($output);
	}


	public function changeIsstatus(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$cat_name_th = $this->getTextformid("kp_cat_post","cat_name_th","cat_id",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_cat_post",array('status'=>$status),"where cat_id = '$id' ");
		}

		if($updatestatus){
			//start function save log transection
			$desclog = "เปลี่ยน $cat_name_th ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "change status $cat_name_th success!";
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "change status $cat_name_th error!";
		}
		echo json_encode($respon);
	}



}
?>

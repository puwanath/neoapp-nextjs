<?php
$param = "products";
require "models/$param.php";
class productsController extends Controllers
{

	//begin function index start page
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$pagemain = "จัดการระบบสินค้า";
		$param = "products";
		$classpage = "collapsed-menu with-subleft";
		$model = new productsController;

		if(isset($_REQUEST['select'])){
			$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		}else{
			$select = isset($_REQUEST['oper']) ? $_REQUEST['oper'] : '';
		}

		if($select!=''):
		switch($select){

			case 'loaddata' :
				 $model->loadData();
				 break;
			case 'loadcategory' :
				 $model->loadCategory();
				 break;
			case 'loadsuppliers' :
				 $model->loadSuppliers();
				 break;
			case 'loadapplication' :
				 $model->loadApplication();
				 break;
			case 'loadprocess' :
				 $model->loadProcess();
				 break;
			case 'loadbrand' :
				 $model->loadBrand();
				 break;
			case 'loadstatus' :
				 $model->loadStatus();
				 break;
			 // case gallery
 			case 'uploadimggall' :
 				 $model->uploadImggall();
 				 break;
 		  	case 'loaddataimg' :
 			   	 $model->loadDataimg();
 			     break;
 		  	case 'delimggall' :
 				 $model->delImggall();
 				 break;
			 // case set is_cover
 			case 'setcovergall' :
 				 $model->setCovergall();
 				 break;
		  	case 'delimg' :
				 $model->delImg();
				 break;
			case 'save' :
				 $model->saveData();
				 break;
			case 'loaddataedit' :
				 $model->loadDataedit();
				 break;
			case 'del' :
				 $model->delData();
				 break;
		  	case 'delselect' :
		 	   	$model->delselectData();
		 	   	break;
		  	case 'isstatus' :
		  	 	$model->changeIsstatus();
		  		break;
			// case document
			case 'loaddatadocument' :
				 $model->loaddataDocument();
			 	 break;
			case 'adddocument' :
			 	 $model->addDocument();
			 	 break;
			case 'deldocument' :
			 	 $model->delDocument();
			 	 break;

			// =============================================== //
			// *********************************************** //
			// =============================================== //

			case 'cloneitem' :
			 	 $model->cloneItem();
			 	 break;

		  // =============================================== //
		  // *********************************************** //
		  // =============================================== //

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
			$userimg = $url.'/images/user/tmp/'.$re->user_avatar;
		}else{
			$userimg = $url.'/images/avatar.jpg';
		}


		$qr = $this->fetchdata("kp_user_level","where level_id = '".$re->user_level."' ");
		$res = $qr->fetch_object();
		$levelname = $res->level_name;

		// permission mwnu
		$mainmenu = array(
			'add'=>'<a href="'.$url.'/products/add" class="btn btn-primary btn-with-icon"><div class="ht-40"><span class="icon wd-40"><i class="fa fa-plus"></i></span><span class="pd-x-15">เพิ่มสินค้าใหม่</span></div></a>',
			'del'=>' <button type="button" id="delselect" class="btn btn-danger btn-with-icon" disabled="true" >
							<div class="ht-40">
								<span class="icon wd-40"><i class="fa fa-trash"></i></span>
								<span class="pd-x-15">ลบที่เลือก</span>
							</div>
						</button>'
		);
		// permission mwnu

		// begin css and js
		$cssarr = array(
			"<link href='".$dir."lib/select2/css/select2.min.css' rel='stylesheet'>",
			"<link href='".$dir."lib/spectrum/spectrum.css' rel='stylesheet'>",
			"<link rel='stylesheet' type='text/css' media='screen' href='".$dir."jqGrid/css/trirand/ui.jqgrid-bootstrap4.css' />",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/i18n/grid.locale-th.js'></script>",
			"<script type='text/ecmascript' src='".$dir."jqGrid/js/trirand/jquery.jqGrid.min.js'></script>",
			"<link href='".$dir."lib/bootstrap-tagsinput/bootstrap-tagsinput.css' rel='stylesheet'>"
		);

		$jsarr = array(
			"<script src='".$dir."lib/select2/js/select2.min.js'></script>",
			"<script src='".$dir."lib/spectrum/spectrum.js'></script>",
			"<script src='".$dir."lib/bootstrap-tagsinput/bootstrap-tagsinput.js'></script>"
		);
		//end css and js script

		if($select==''){
			if($get_part1=='add' or $get_part1=='edit'){
				if($get_part1=='add'){ $pagename = "เพิ่มสินค้า"; }else{$pagename = "แก้ไขสินค้า";}

				$content = "views/$param/form.php";
			}else{
				$pagename = "รายการสินค้า";
				$content = "views/$param/index.php";
			}

			$page = include("views/layout/template.php");
			return $page;
		}
	}
	//end function page

	public function loadData(){
		$arr = array();
		$urlweb = curPageURLWeb();
		include "common/include/config.php";
		$requestData= $_REQUEST;

		$pageno = $requestData["page"];
		$rows = $requestData["rows"];
		$sidx = $requestData["sidx"];
		$sord = $requestData["sord"];
		if (!$sidx) $sidx = 1;

		$sql = "select count(*) as rowcount from kp_products where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( prodname_th LIKE '%{$requestData['search']}%' ";
			$sql.= "OR prodname_en LIKE '%{$requestData['search']}%' ";
			$sql.= "OR slug LIKE '%{$requestData['search']}%' ";
			$sql.= "OR prodcode LIKE '%{$requestData['search']}%' ) ";
		}
		if( !empty($requestData['cat_id']) and $requestData['cat_id']!='all') {
			$sql.= "AND FIND_IN_SET('{$requestData['cat_id']}',cat_id) ";
		}
		$rowcount= $dbCon->query($sql)->fetch_assoc()['rowcount'];
		$start = $rows * ($pageno -1);

		$sql = "select * from kp_products where is_delete = 0 ";
		if( !empty($requestData['search']) ) {
			$requestData['search']=addslashes($requestData['search']);
			$sql.= "AND ( prodname_th LIKE '%{$requestData['search']}%' ";
			$sql.= "OR prodname_en LIKE '%{$requestData['search']}%' ";
			$sql.= "OR slug LIKE '%{$requestData['search']}%' ";
			$sql.= "OR prodcode LIKE '%{$requestData['search']}%' ) ";
		}
		if( !empty($requestData['cat_id']) and $requestData['cat_id']!='all') {
			$sql.= "AND FIND_IN_SET('{$requestData['cat_id']}',cat_id) ";
		}
		$sql.= "order by $sidx $sord ";
		$sql.= "limit $start , $rows ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		while($res= $qr->fetch_object()){
			$prodid = $res->prodid;
			$prodcode = $res->prodcode;
			$prodname_th = $res->prodname_th;
			$prodname_en = $res->prodname_en;
			$prodprice = $res->prodprice;
			$prodprice_promotion = $res->prodprice_promotion;
			$prodqty = $res->qty;
			$cat_name = $this->getFunCat($res->cat_id);
			$app_name = $this->getFunApplication($res->app_id);
			$process_name = $this->getFunProcess($res->process_id);
			$supp_name = $this->getTextformid('kp_products_suppliers','supp_name_th','supp_id',$res->supp_id);
			$brand_name = $this->getTextformid('kp_products_brand','brand_name','brand_id',$res->brand_id);
			$prodimg = $this->getPicmain($prodid);

			$created = date("d/m/Y H:i:s",strtotime($res->create_date));
			$creator = $this->getTextformid('kp_users','user_fullname','user_id',$res->user_create);

			$btn_clone = "<button type=\"button\" onclick=\"cloneFunc('$prodid','{$prodname_th}')\" class=\"btn btn-sm btn-dark\"><i class=\"fa fa-clone\"></i></button>";
			$btn_status = "<button type=\"button\" onclick=\"isFuncStatus('".($res->status==1?0:1)."','{$prodid}')\" class=\"btn btn-sm ".($res->status==1?'btn-success':'btn-secondary')."\"><i class=\"fa fa-check\"></i></button>";

			$btn_act = array(
				"edit"=>" <button type=\"button\" onclick=\"editFunc('$prodid');\" class=\"btn btn-sm btn-warning editform\"><i class=\"icon ion-edit\"></i></button>",
				"del"=>" <button type=\"button\" onclick=\"delFunc('$prodid','{$prodname_th}');\" class=\"btn btn-sm btn-danger delitem\"><i class=\"icon ion-trash-a\"></i></button>"
			);
			$btnaction = '<div class="btn-group" role="group" aria-label="">';
			$btnaction.= $btn_clone.$btn_status.$btn_sort.getMenu_permission_button($btn_act);
			$btnaction.= '</div>';

			$row = array();
			$row['prodid'] = $prodid;
			$row['prodcode'] = $prodcode;
			$row['prodname_th'] = $prodname_th;
			$row['prodname_en'] = $prodname_en;
			$row['cat_id'] = $cat_name;
			$row['app_id'] = $app_name;
			$row['supp_id'] = $supp_name;
			$row['process_id'] = $process_name;
			$row['brand_id'] = $brand_name;
			$row['prodprice'] = $prodprice;
			$row['prodprice_promotion'] = $prodprice_promotion;
			$row['qty'] = $prodqty;
			$row['prodimg'] = $prodimg;
			$row['created'] = $created;
			$row['creator'] = $creator;
			$row['btn_act'] = $btnaction;
			$arr[] = $row;
		}
		$output = array();
		$output['records'] = $rowcount;
		$output['page'] = $pageno;
		$output['total'] = ceil($rowcount/$rows);
		$output['rows'] = $arr;
		// $output[err] = $sql;

		echo json_encode($output);
	}

	public function getFunCat($arrid){
		$setid = explode(',',$arrid);
		$setid = "'".implode("','",$setid)."'";
		$qr = $this->fetchdata("kp_products_category","where is_delete = 0 and cat_id in ($setid) ");
		foreach ($qr as $res) {
			$row[] = $res['cat_name_th'];
		}

		return implode(',',$row);
	}

	public function getFunApplication($arrid){
		$setid = explode(',',$arrid);
		$setid = "'".implode("','",$setid)."'";
		$qr = $this->fetchdata("kp_applications","where is_delete = 0 and app_id in ($setid) ");
		foreach ($qr as $res) {
			$row[] = $res['app_name_th'];
		}

		return implode(',',$row);
	}

	public function getFunProcess($arrid){
		$setid = explode(',',$arrid);
		$setid = "'".implode("','",$setid)."'";
		$qr = $this->fetchdata("kp_process","where is_delete = 0 and process_id in ($setid) ");
		foreach ($qr as $res) {
			$row[] = $res['process_name_th'];
		}

		return implode(',',$row);
	}


	public function getPicmain($id){
		$urlweb = curPageURLweb();
		$qr = $this->fetchdata("kp_products_img","where prodid = '$id' and is_cover = 1 order by sort asc limit 0,1 ");
		$res = $qr->fetch_object();

		if(!empty($res->prodimg)){
			if(file_exists("../images/products/$res->prodimg")==true){
				$img = $urlweb."/images/products/$res->prodimg";
				$img = "<img src='$img' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
			}else{
				$img = $urlweb."/images/no-img.jpg";
				$img = "<img src='$img' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
			}
		}else{
			$img = $urlweb."/images/no-img.jpg";
			$img = "<img src='$img' class='img-fluid rounded-circle' style='width:30px;height:30px;'/>";
		}

		return $img;
	}


	// brgin function loadCategorymain
	public function loadCategory(){
		$url = curPageURL();
		$id = $_REQUEST['id'];

		$arr = array();
		$qr = $this->fetchdata("kp_products_category","where is_delete=0 and status=1 order by sort asc ");
		while($res = $qr->fetch_object()){

			$arr['id'] = $res->cat_id;
			$arr['name']= $res->cat_name_th;

			$respon['datarow'][] = $arr;
		}
		echo json_encode($respon);
	}
	// end function loadCategorymain

	// brgin function load application
	public function loadApplication(){
		$url = curPageURL();
		$id = $_REQUEST['id'];

		$arr = array();
		$qr = $this->fetchdata("kp_applications","where is_delete=0 and status=1 order by app_name_th asc ");
		while($res = $qr->fetch_object()){

			$arr['id'] = $res->app_id;
			$arr['name']= $res->app_name_th;

			$respon['datarow'][] = $arr;
		}
		echo json_encode($respon);
	}
	// end function load application

	// brgin function load process
	public function loadProcess(){
		$url = curPageURL();
		$id = $_REQUEST['id'];

		$arr = array();
		$qr = $this->fetchdata("kp_process","where is_delete=0 and status=1 order by process_name_th asc ");
		while($res = $qr->fetch_object()){

			$arr['id'] = $res->process_id;
			$arr['name']= $res->process_name_th;

			$respon['datarow'][] = $arr;
		}
		echo json_encode($respon);
	}
	// end function load process

	// brgin function load suppliers
	public function loadSuppliers(){
		$url = curPageURL();
		$id = $_REQUEST['id'];

		$arr = array();
		$qr = $this->fetchdata("kp_products_suppliers","where is_delete=0 and status=1 order by supp_name_th asc ");
		while($res = $qr->fetch_object()){

			$arr['id'] = $res->supp_id;
			$arr['name']= $res->supp_name_th;

			$respon['datarow'][] = $arr;
		}
		echo json_encode($respon);
	}
	// end function load suppliers

	// brgin function loadBrand
	public function loadBrand(){
		$url = curPageURL();
		$id = $_REQUEST['id'];

		$arr = array();
		$qr = $this->fetchdata("kp_products_brand","where is_delete=0 and status=1 order by sort asc ");
		while($res = $qr->fetch_object()){

			$arr['id'] = $res->brand_id;
			$arr['name']= $res->brand_name;

			$respon['datarow'][] = $arr;
		}
		echo json_encode($respon);
	}
	// end function loadbrand

	// brgin function loadStatus
	public function loadStatus(){
		$url = curPageURL();
		$id = $_REQUEST['id'];

		$arr = array();
		$qr = $this->fetchdata("kp_products_status","where 1=1 order by prodstatus_id asc ");
		while($res = $qr->fetch_object()){
			$arr['id'] = $res->prodstatus_id;
			$arr['name']= $res->prodstatus_name_th;
			$respon['datarow'][] = $arr;
		}
		echo json_encode($respon);
	}
	// end function loadStatus

	//brgin function loadtype
	public function loadProdtype(){
		$arr = array();
		$qr = $this->fetchdata("kp_products_type","where 1 order by id asc ");
		while($res = $qr->fetch_object()){
			$data = '<option value="'.$res->id.'">'.$res->prodtype_name_th.'</option>';
			array_push($arr,$data);
		}
		return implode('',$arr);
	}
	//end fucntion loadtype

	// begin function load data attribute
	public function loadDataattribute(){
		$url = curPageURL();
		$arr = array();
		$qr = $this->fetchdata("kp_products_varible","where is_delete=0 and status=1 order by sort asc");
		$num = $qr->num_rows;
		if($num>0):
			$numcol = 12/$num;
			while($res = $qr->fetch_object()){
				$data = "<div class=\"col-md-$numcol\">";
				$data.= "<div class=\"form-group bd-t-0-force bd-l-0-force pd-10-force\">";
				$data.= "<label class=\"form-control-label tx-bold\">$res->var_name_th: </label>";
				$data.= "<div class=\"form-layout form-layout-8 mg-t-5\" >";
				// =================== //
				$data.= "<table id=\"dataattr_$res->var_param\" class=\"table table-striped\" style=\"width:100%;\">";
				$data.= "<tr>";
				$data.= "<td style=\"padding: 0px 8px 0px;\"><input type=\"checkbox\" name=\"chk\"  /><input type=\"hidden\" name=\"var_id[]\" value=\"$res->var_id\" /></td>";
				$data.= "<td style=\"padding: 0px 8px 0px;\"><input type=\"text\" name=\"desc_text[]\" class=\"form-control\" placeholder=\"...\"/></td>";
				if($res->var_input_type=='color'){
					$data.= "<td style=\"width:20%;padding: 0px 8px 0px;\"><input type=\"$res->var_input_type\" name=\"desc_code[]\" class=\"form-control\"  /></td>";
				}else{
					$data.= "<td style=\"width:20%;padding: 0px 8px 0px;\"><input type=\"hidden\" name=\"desc_code[]\" value=\"\" class=\"form-control\"  /></td>";
				}
				$data.= "</tr>";
				$data.= "</table>";

				$data.= "<div style=\"padding-top:5px;padding-bottom:5px;\">
					<button type=\"button\" class=\"btn btn-primary btn-sm\" onclick=\"addRow('dataattr_$res->var_param')\" >เพิ่มรายการ</button>
					<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"deleteRow('dataattr_$res->var_param')\" >ลบที่เลือก</button>
				</div>";

				// =================== //
				$data.= "</div>";
				$data.= "</div>";
				$data.= "</div>";

				array_push($arr,$data);
			}
		endif;


		return implode('',$arr);
	}
	// end function load data attribute

	//begin function saveData
	public function saveData()
	{
		$readData = $_POST;
		$formdata['prodcode'] = $readData['prodcode'];
		$formdata['prodname_th'] = addslashes($readData['prodname_th']);
		$formdata['prodname_en'] = addslashes($readData['prodname_en']);
		$formdata['slug'] = str_replace(' ','-',$readData['slug']);
		$formdata['prodshortdetail_th'] = addslashes($readData['prodshortdetail_th']);
		$formdata['prodshortdetail_en'] = addslashes($readData['prodshortdetail_en']);
		$formdata['proddetail_th'] = addslashes($readData['proddetail_th']);
		$formdata['proddetail_en'] = addslashes($readData['proddetail_en']);
		$formdata['prodlink'] = $readData['prodlink'];
		$formdata['prodlink2'] = $readData['prodlink2'];
		$formdata['prodlink3'] = $readData['prodlink3'];
		$formdata['prodprice'] = $readData['prodprice'];
		$formdata['prodprice_promotion'] = $readData['prodprice_promotion'];
		$formdata['qty'] = $readData['qty'];
		$formdata['brand_id'] = $readData['brand_id'];
		$formdata['supp_id'] = $readData['supp_id'];
		$formdata['prodstatus'] = $readData['prodstatus'];
		$formdata['seo_title'] = addslashes($readData['seo_title']);
		$formdata['seo_desc'] = addslashes($readData['seo_desc']);
		$formdata['prodtag'] = $readData['prodtag'];
		$formdata['is_shipping'] = $readData['is_shipping'];
		$formdata['shipping_amount'] = $readData['shipping_amount'];
		$formdata['weight'] = $readData['weight'];
		$formdata['size_width'] = $readData['size_width'];
		$formdata['size_long'] = $readData['size_long'];
		$formdata['size_height'] = $readData['size_height'];

		/*=======================product type =====================*/
		$arrprodtype = array();
		if(isset($readData['prodtype'])){
			foreach($readData['prodtype'] as $trnprodtype)
			{
				$prodtype_id = $trnprodtype;
				if(isset($prodtype_id)){
					array_push($arrprodtype,$prodtype_id);
				}

			}
			$prodtype = implode(',',$arrprodtype);
			$formdata['prodtype'] = $prodtype;
		}
		/*=======================product type =====================*/

		/*=======================product Category =====================*/
		$arrcategory = array();
		if(isset($readData['cat_id'])){
			foreach($readData['cat_id'] as $trncategory)
			{
				$cat_id = $trncategory;
				if(isset($cat_id)){
					array_push($arrcategory,$cat_id);
				}

			}
			$prodcat_id = implode(',',$arrcategory);
			$formdata['cat_id'] = $prodcat_id;
		}
		/*=======================product Category =====================*/

		/*=======================product application =====================*/
		$arrapp = array();
		if(isset($readData['app_id'])){
			foreach($readData['app_id'] as $trnapp)
			{
				$app_id = $trnapp;
				if(isset($app_id)){
					array_push($arrapp,$app_id);
				}

			}
			$prodapp_id = implode(',',$arrapp);
			$formdata['app_id'] = $prodapp_id;
		}
		/*=======================product application =====================*/

		/*=======================product process =====================*/
		$arrprocess = array();
		if(isset($readData['process_id'])){
			foreach($readData['process_id'] as $trnprocess)
			{
				$process_id = $trnprocess;
				if(isset($process_id)){
					array_push($arrprocess,$process_id);
				}

			}
			$prodprocess_id = implode(',',$arrprocess);
			$formdata['process_id'] = $prodprocess_id;
		}
		/*=======================product application =====================*/

		if(empty($readData['prodid'])&&$readData['prodid']==''){
			$prodid = $this->NewID('P','prodid','kp_products');
			$formdata['prodid'] = $prodid;
			$formdata['is_delete'] = 0;
			$formdata['status'] = 1;
			$formdata['user_create'] = getSession();
			$save = $this->insertrow("kp_products",$formdata);

			/*=======================product option1 =====================*/
			$this->delrow("kp_products_options","where prodid = '{$prodid}' ");
			if(!empty($readData['optionvalue1'])){
				foreach($readData['optionvalue1'] as $trnopt1)
				{
					if(!empty($trnopt1)){
						$form_data_opt1['option_name'] = $trnopt1;
						$form_data_opt1['option_value'] = "option1";
						$form_data_opt1['prodid'] = $prodid;
						$this->insertrow("kp_products_options",$form_data_opt1);
					}
				}
			}
			/*=======================product option1 =====================*/

			/*=======================product option2 =====================*/
			if(!empty($readData['optionvalue2'])){
				$opt2=0;
				foreach($readData['optionvalue2'] as $trnopt2)
				{
					if(!empty($trnopt2)){
						$form_data_opt2['option_name'] = $trnopt2;
						$form_data_opt2['option_value'] = "option2";
						$form_data_opt2['option_type'] = $readData['optionvalue3'][$opt2];
						$form_data_opt2['prodid'] = $prodid;
						$this->insertrow("kp_products_options",$form_data_opt2);
					}
					$opt2++;
				}
			}
			/*=======================product option2 =====================*/

			/*=======================product option3 =====================*/
			// if(!empty($readData['optionvalue3'])){
			// 	foreach($readData['optionvalue3'] as $trnopt3)
			// 	{
			// 		if(!empty($trnopt3)){
			// 			$form_data_opt3['option_name'] = $trnopt3;
			// 			$form_data_opt3['option_value'] = "option3";
			// 			$form_data_opt3['prodid'] = $prodid;
			// 			$this->insertrow("kp_products_options",$form_data_opt3);
			// 		}
			// 	}
			// }
			/*=======================product option3 =====================*/

			/*=======================product option2 detail =====================*/
			$kk = 0;
			$this->delrow("kp_products_options_lists","where prodid = '{$prodid}' ");
			if(!empty($readData['option1'])){
				foreach($readData['option1'] as $trnoption)
				{
					if(!empty($trnoption)){
						$form_data_option['option_1'] = $trnoption;
						$opt=2;
						for($i=$opt;$i<=25;$i++){

							if($readData['optiontype'.$i][$kk]=='text'){
								$form_data_option['option_'.$i] = ($readData['option'.$i][$kk]==''?$prodid:$readData['option'.$i][$kk]);
							}else if($readData['optiontype'.$i][$kk]=='button'){
								$form_data_option['option_'.$i] = ($readData['option'.$i][$kk]==''?$prodid:$readData['option'.$i][$kk]);
							}else{
								$doc_name = $prodid.$kk.'-'.time().'.'.substr($_FILES["option{$i}"]["name"][$kk],-3,3);
								if(move_uploaded_file($_FILES["option{$i}"]["tmp_name"][$kk],"../images/download/".$doc_name))
								{
									$url = curPageURLWeb();
									$linkdownload = "{$url}/images/download/{$doc_name}";
									$form_data_option['option_'.$i] = $linkdownload;
								}

							}


						}


						$form_data_option['prodid'] = $prodid;
						$this->insertrow("kp_products_options_lists",$form_data_option);
					}
					$kk++;
				}
			}
			/*=======================product option2 =====================*/

			if($save===TRUE){
				//start function save log transection
				$desclog = "เพิ่ม [สินค้า] ชื่อ {$readData['prodname_th']}";
				savelog(getSession(),$desclog);
				//end function save log transection

				$output['status'] = 'success';
				$output['msg'] = 'Create product success!';
				$output['id'] = $prodid;
				echo json_encode($output);
				exit;
			}else{
				$output['status'] = 'fail';
				$output['msg'] = 'Create product fail!';
				$output['id'] = '';
				echo json_encode($output);
				exit;
			}
		}else{
			$prodid = $readData['prodid'];
			$save = $this->updaterow("kp_products",$formdata,"where prodid = '{$prodid}' ");

			/*=======================product option1 =====================*/
			$this->delrow("kp_products_options","where prodid = '{$prodid}' ");
			if(!empty($readData['optionvalue1'])){
				foreach($readData['optionvalue1'] as $trnopt1)
				{
					if(!empty($trnopt1)){
						$form_data_opt1['option_name'] = $trnopt1;
						$form_data_opt1['option_value'] = "option1";
						$form_data_opt1['prodid'] = $prodid;
						$this->insertrow("kp_products_options",$form_data_opt1);
					}
				}
			}
			/*=======================product option1 =====================*/

			/*=======================product option2 =====================*/
			if(!empty($readData['optionvalue2'])){
				$opt2=0;
				foreach($readData['optionvalue2'] as $trnopt2)
				{
					
					if(!empty($trnopt2)){
						$form_data_opt2['option_name'] = $trnopt2;
						$form_data_opt2['option_value'] = "option2";
						$form_data_opt2['option_type'] = $readData['optionvalue3'][$opt2];
						$form_data_opt2['prodid'] = $prodid;
						$this->insertrow("kp_products_options",$form_data_opt2);
					}
					$opt2++;
				}
			}
			/*=======================product option2 =====================*/


			/*=======================product option2 detail =====================*/
			$kk = 0;
			$this->delrow("kp_products_options_lists","where prodid = '{$prodid}' ");
			if(!empty($readData['option1'])){
				foreach($readData['option1'] as $trnoption)
				{
					if(!empty($trnoption)){
						$form_data_option['option_1'] = $trnoption;
						$opt=2;
						for($i=$opt;$i<=25;$i++){

							if($readData['optiontype'.$i][$kk]=='text'){
								$form_data_option['option_'.$i] = ($readData['option'.$i][$kk]==''?$prodid:$readData['option'.$i][$kk]);
							}else if($readData['optiontype'.$i][$kk]=='button'){
								$form_data_option['option_'.$i] = ($readData['option'.$i][$kk]==''?$prodid:$readData['option'.$i][$kk]);
							}else{
								$doc_name = $prodid.$kk.'-'.time().'.'.substr($_FILES["option{$i}"]["name"][$kk],-3,3);
								if(move_uploaded_file($_FILES["option{$i}"]["tmp_name"][$kk],"../images/download/".$doc_name))
								{
										$url = curPageURLWeb();
										$linkdownload = "{$url}/images/download/{$doc_name}";
										$form_data_option['option_'.$i] = $linkdownload;
								}

							}


						}


						$form_data_option['prodid'] = $prodid;
						$this->insertrow("kp_products_options_lists",$form_data_option);
					}
					$kk++;
				}
			}
			/*=======================product option2 =====================*/

			if($save===TRUE){
				//start function save log transection
				$desclog = "อัพเดท [สินค้า] ชื่อ {$readData['prodname_th']}";
				savelog(getSession(),$desclog);
				//end function save log transection

				$output['status'] = 'success';
				$output['msg'] = 'Update product success!';
				$output['id'] = $prodid;
				echo json_encode($output);
				exit;
			}else{
				$output['status'] = 'fail';
				$output['msg'] = 'Update product fail!';
				$output['id'] = '';
				echo json_encode($output);
				exit;
			}


		}
	}
	//end function saveData

	//begin function loaddataedit
	public function loadDataedit(){
		include "common/include/config.php";
		$urlweb = curPageURLweb();
		$readData = $_REQUEST;
		$id = $readData['id'];
		$qr = $this->fetchdata("kp_products","where prodid = '{$id}' ");
		$res = $qr->fetch_object();
		$prodid = $res->prodid;
		$output = array();
		$output['prodid'] = $res->prodid;
		$output['prodcode'] = $res->prodcode;
		$output['prodname_th'] = $res->prodname_th;
		$output['prodname_en'] = $res->prodname_en;
		$output['slug'] = $res->slug;
		$output['prodshortdetail_th'] = $res->prodshortdetail_th;
		$output['prodshortdetail_en'] = $res->prodshortdetail_en;
		$output['proddetail_th'] = $res->proddetail_th;
		$output['proddetail_en'] = $res->proddetail_en;
		$output['prodlink'] = $res->prodlink;
		$output['prodlink2'] = $res->prodlink2;
		$output['prodlink3'] = $res->prodlink3;
		$output['prodprice'] = $res->prodprice;
		$output['prodprice_promotion'] = $res->prodprice_promotion;
		$output['qty'] = $res->qty;
		$output['app_id'] = $res->app_id;
		$output['process_id'] = $res->process_id;
		$output['supp_id'] = $res->supp_id;
		$output['cat_id'] = $res->cat_id;
		$output['brand_id'] = $res->brand_id;
		$output['prodstatus'] = $res->prodstatus;
		$output['prodtype'] = $res->prodtype;
		$output['seo_title'] = $res->seo_title;
		$output['seo_desc'] = $res->seo_desc;
		$output['prodtag'] = $res->prodtag;
		$output['is_shipping'] = $res->is_shipping;
		$output['shipping_amount'] = $res->shipping_amount;
		$output['weight'] = $res->weight;
		$output['size_width'] = $res->size_width;
		$output['size_long'] = $res->size_long;
		$output['size_height'] = $res->size_height;

		//product category
		$qrcat = $this->fetchdata("kp_products_category","where is_delete=0 and status=1 order by sort asc ");
		while($rescat = $qrcat->fetch_assoc()){
			$arrcat['id'] = $rescat['cat_id'];
			$arrcat['name']= $rescat['cat_name_th'];
			$output['catarr'][] = $arrcat;
		}

		//product application
		$qrapp = $this->fetchdata("kp_applications","where is_delete=0 and status=1 order by app_name_th asc ");
		while($resapp = $qrapp->fetch_assoc()){
			$arrapp['id'] = $resapp['app_id'];
			$arrapp['name']= $resapp['app_name_th'];
			$output['apparr'][] = $arrapp;
		}

		//product process
		$qrprocess = $this->fetchdata("kp_process","where is_delete=0 and status=1 order by process_name_th asc ");
		while($resprocess = $qrprocess->fetch_assoc()){
			$arrprocess['id'] = $resprocess['process_id'];
			$arrprocess['name']= $resprocess['process_name_th'];
			$output['processarr'][] = $arrprocess;
		}

		//product suppliers
		$qrsupp = $this->fetchdata("kp_products_suppliers","where is_delete=0 and status=1 order by supp_name_th asc ");
		while($ressupp = $qrsupp->fetch_assoc()){
			$arrsupp['id'] = $ressupp['supp_id'];
			$arrsupp['name']= $ressupp['supp_name_th'];
			$output['supparr'][] = $arrsupp;
		}

		//product brand
		$qrbrand = $this->fetchdata("kp_products_brand","where is_delete=0 and status=1 order by sort asc ");
		while($resbrand = $qrbrand->fetch_assoc()){
			$arrbrand['id'] = $resbrand['brand_id'];
			$arrbrand['name']= $resbrand['brand_name'];
			$output['brandarr'][] = $arrbrand;
		}

		//product status
		$qrstatus = $this->fetchdata("kp_products_status","order by prodstatus_name_th asc ");
		while($resstatus = $qrstatus->fetch_assoc()){
			$arrstatus['id'] = $resstatus['prodstatus_id'];
			$arrstatus['name']= $resstatus['prodstatus_name_th'];
			$output['statusarr'][] = $arrstatus;
		}


		if(!empty($res->proddatasheet)){
			$proddatasheet = $res->proddatasheet;
			$datasheet = "<a href='{$urlweb}/products-datasheet/{$proddatasheet}' target='_blank'>{$proddatasheet}</a> ";
			$datasheet.= " <button type=\"button\" onclick=\"delDocument('{$prodid}','{$proddatasheet}');\" class=\"btn btn-sm btn-danger\"> ลบ </button>";
		}else{
			$datasheet = "<button type=\"button\" class=\"btn btn-sm btn-purple\" onclick=\"btngetfile('doc_file')\" ><i class=\"fa fa-file-text-o\"></i> Upload Datasheet </button>";
		}
		$output['proddatasheet'] = $datasheet;

		$output['created'] = date("d/m/Y H:i:s",strtotime($res->create_date));
		$output['creator'] = $this->getTextformid('kp_users','user_fullname','user_id',$res->user_create);

		$qroption = $this->fetchdata("kp_products_options","where prodid = '{$id}'  order by id asc ");
		while($resoption = $qroption->fetch_assoc()){
			if($resoption['option_value']=='option1'){
				$arroption['name'] = $resoption['option_name'];
				$arroption['valuename'] = $resoption['option_value'];
				$arroptionrow['list1'][] =$arroption;
			}
			if($resoption['option_value']=='option2'){
				$arroption['name'] = $resoption['option_name'];
				$arroption['valuename'] = $resoption['option_value'];
				$arroption['type'] = $resoption['option_type'];
				$arroptionrow['list2'][] =$arroption;
			}
		}
		$output['optionarr'][] = $arroptionrow;

		$qropt2 = $dbCon->query("select DISTINCT option_name from kp_products_options where prodid = '{$id}' and option_value='option2'  ORDER BY id asc") or die($dbCon->error);
		while($resopt2 = $qropt2->fetch_assoc()){
			$opt2['val'] =  $resopt2['option_name'];
			$output['option2'][] = $opt2;
		}

		$qroptionlist = $this->fetchdata("kp_products_options_lists","where prodid = '{$id}'  order by id asc ");
		while($resoptionlist = $qroptionlist->fetch_assoc()){
			$arroptionlist['option_1'] = $resoptionlist['option_1'];
			$arroptionlist['optionval'][] = $resoptionlist['option_2'];
			$arroptionlist['optionval'][] = $resoptionlist['option_3'];
			$arroptionlist['optionval'][] = $resoptionlist['option_4'];
			$arroptionlist['optionval'][] = $resoptionlist['option_5'];
			$arroptionlist['optionval'][] = $resoptionlist['option_6'];
			$arroptionlist['optionval'][] = $resoptionlist['option_7'];
			$arroptionlist['optionval'][] = $resoptionlist['option_8'];
			$arroptionlist['optionval'][] = $resoptionlist['option_9'];
			$arroptionlist['optionval'][] = $resoptionlist['option_10'];
			$arroptionlist['optionval'][] = $resoptionlist['option_11'];
			$arroptionlist['optionval'][] = $resoptionlist['option_12'];
			$arroptionlist['optionval'][] = $resoptionlist['option_13'];
			$arroptionlist['optionval'][] = $resoptionlist['option_14'];
			$arroptionlist['optionval'][] = $resoptionlist['option_15'];
			$arroptionlist['optionval'][] = $resoptionlist['option_16'];
			$arroptionlist['optionval'][] = $resoptionlist['option_17'];
			$arroptionlist['optionval'][] = $resoptionlist['option_18'];
			$arroptionlist['optionval'][] = $resoptionlist['option_19'];
			$arroptionlist['optionval'][] = $resoptionlist['option_20'];
			$arroptionlist['optionval'][] = $resoptionlist['option_21'];
			$arroptionlist['optionval'][] = $resoptionlist['option_22'];
			$arroptionlist['optionval'][] = $resoptionlist['option_23'];
			$arroptionlist['optionval'][] = $resoptionlist['option_24'];
			$arroptionlist['optionval'][] = $resoptionlist['option_25'];
			$arroptionlist['prodid'] = $resoptionlist['prodid'];
			$output['optionlistarr'][] = $arroptionlist;
			unset($arroptionlist);
		}
		


		$arrprodtype = array();
		$qr = $this->fetchdata("kp_products_type","where 1 order by id asc ");
		while($res = $qr->fetch_object()){
			$arrprodtype['id'] = $res->id;
			$arrprodtype['name']= $res->prodtype_name_th;
			$output['dataprodtype'][] = $arrprodtype;
		}


		echo json_encode($output);
	}
	//end function loaddataedit


	//begin function delData
	public function delData()
	{
		$id = $_REQUEST['id'];
		$qr = $this->fetchdata("kp_products","where prodid = '$id' ");
		$res= $qr->fetch_object();
		$prodname_th = $res->prodname_th;
		if(($qr->num_rows)>0):
		  $del = $this->updaterow("kp_products",array('is_delete'=>'1'),"where prodid = '$id' ");
		endif;

		if($del){

			//start function save log transection
			$desclog = "ลบ [สินค้า] ชื่อ $prodname_th";
			savelog(getSession(),$desclog);
			//end function save log transection


			$jsonstatus = "success";
			$jsonrespontext = "Delete [$prodname_th] success!";
			$jsonmsg = "ลบ ข้อมูลสินค้า [$prodname_th] สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Delete [$prodname_th] error!";
			$jsonmsg = "ไม่สามารถ ลบ ข้อมูลสินค้า [$prodname_th] สำเร็จ  กรุณาติดต่อ Support";
		}

		$respon = array('status'=>$jsonstatus,'respontext'=>$jsonrespontext,'msg'=>$jsonmsg);
		echo json_encode($respon);
	}
	//end function delData

	//begin function delselectData
	public function delselectData()
	{
		$set_id = $_REQUEST['setid'];
		// $set_id = explode(',',$set_id);

		foreach ($set_id as $key => $value) {
			$id = $value;
			if(isset($id)){
				$del = $this->updaterow("kp_products",array('is_delete'=>'1'),"where prodid = '$id' ");
			}
		}

		if($del){
			$set_id = implode(',',$set_id);
			//start function save log transection
			$desclog = "ลบ [ช้อมูลสินค้าตามที่เลือก] Set $set_id";
			savelog(getSession(),$desclog);
			//end function save log transection

			$jsonstatus = "success";
			$jsonrespontext = "Delete [$set_id] success!";
			$jsonmsg = "ลบ ข้อมูลสินค้าตามที่เลือก [$set_id] สำเร็จ!";
		}else{
			$jsonstatus = "error";
			$jsonrespontext = "Delete [$set_id] error!";
			$jsonmsg = "ไม่สามารถ ลบ ข้อมูลสินค้าตามที่เลือก [$set_id] สำเร็จ  กรุณาติดต่อ Support";
		}

		$respon = array('status'=>$jsonstatus,'respontext'=>$jsonrespontext,'msg'=>$jsonmsg);
		echo json_encode($respon);
	}
	//end function delselectData


	public function changeIsstatus(){
		$id = $_REQUEST['id'];
		$status = $_REQUEST['status'];
		$prodname_th = $this->getTextformid("kp_products","prodname_th","prodid",$id);

		if($id){
			$updatestatus = $this->updaterow("kp_products",array('status'=>$status),"where prodid = '$id' ");
		}


		if($updatestatus){
			$jsonstatus = "success";
			$jsonmsg = "เปลี่ยน $prodname_th ให้เปิดใช้งาน สำเร็จ!";

			//start function save log transection
			$desclog = "เปลี่ยน $prodname_th ให้เปิดใช้งาน สำเร็จ!";
			savelog(getSession(),$desclog);
			//end function save log transection

		}else{
			$jsonstatus = "error";
			$jsonmsg = "ไม่สามารถเปลี่ยน $prodname_th ให้เปิดใช้งาน ได้ กรุณาติดต่อ Support";
		}
		$respon = array("status"=>"$jsonstatus","msg"=>"$jsonmsg");
		echo json_encode($respon);
	}


	// function gallery set is_cover
	// ========================================================================//
	public function setCovergall(){
		$id = $_REQUEST['id'];
		$gallid = $_REQUEST['gallid'];

		if($id!=''){
			$update = $this->updaterow("kp_products_img",array('is_cover'=>''),"where  prodid  = '$id' ");
			$update = $this->updaterow("kp_products_img",array('is_cover'=>'1'),"where id = '$gallid' and prodid  = '$id' ");
		}

		if($update){
			$status = "success";
			$msg = "Set Cover Success!";
		}else{
			$status = "error";
			$msg = "Set Cover Error!";
		}
		$respon = array('status'=>$status,'msg'=>$msg,'id'=>$id);
		echo json_encode($respon);

	}
	// ========================================================================//

	// function product img
	// upload product img
	// ========================================================================//
	public function uploadImggall()
	{
		$id = getSession();
		$img = $_REQUEST['img'];
		if($_REQUEST['prodid']!=''){
			$prodid = $_REQUEST['prodid'];
		}else{
			$prodid = $this->NewID("P","prodid","kp_products");
		}
		$usercreate = getSession();
		$img = $_FILES['fle'];
		// $file      = $_FILES['fle']['name'];
		// $file_tmp  = $_FILES['fle']['tmp_name'];
		// $file_type = $_FILES['fle']['type'];
		if(!empty($img))
		{
				require 'common/functions/functions_images.php';
				$img_desc = reArrayFiles($img);
				$sortnum = $this->sortMax('kp_products_img','sort',"where prodid = '{$prodid}' ");
				foreach($img_desc as $val)
				{
					$dot = substr($val['name'],-3,3);
					$pic_name = 'projectgall-'.$prodid.'-'.time().'-'.$sortnum.'.'.$dot;
					resize($val['type'],$val['tmp_name'],$pic_name,400,"../images/products/tmp/");
					copy($val['tmp_name'],"../images/products/$pic_name");

					$form_data['prodid'] = $prodid;
					$form_data['prodimg'] = $pic_name;
					$form_data['is_cover'] = 0;
					$form_data['sort'] = $sortnum;
					$insertimg = $this->insertrow('kp_products_img', $form_data);
					$sortnum++;
				}

				if(empty($_REQUEST['prodid'])){
					$insertitem = $this->insertrow("kp_products",array('prodid'=>$prodid,'is_delete'=>0,'status'=>1,'user_create'=>$usercreate));
				}

		}


		if($insertimg){
			$output['status'] = "success";
			$output['msg'] = "Upload image success!";
			$output['id'] = $prodid;
		}else{
			$output['status'] = "fail";
			$output['msg'] = "Upload image fail!";
			$output['id'] = $prodid;
		}

		echo json_encode($output);
	}
	// ========================================================================//
	public function loaddataImg(){
		$id = $_GET['id'];
		$url = curPageURL();
		$url2 = curPageURLweb();
		$arr = array();
		$qr = $this->fetchdata("kp_products_img","where prodid = '".$id."' order by sort,is_cover asc ");
		while($res = $qr->fetch_assoc()){

			if(file_exists("../images/products/tmp/{$res['prodimg']}")){
				$img = "$url2/images/products/tmp/{$res['prodimg']}";

				if($res['is_cover']==1){
					$iscover = "<i class=\"fa fa-check\"></i>";
				}else{
					$iscover = "";
				}

				$gall_id = $res['id'];
				$prodid = $res['prodid'];

				$data = "<div class=\"col-xs-12 col-sm-6 col-md-3 pd-x-5 pd-y-5\">";
				$data.= "<div class=\"col-item rounded\" style=\"background-image:url('$img');background-position: center center;background-repeat: no-repeat;background-size: cover;\">";
				$data.= "<div class=\"col-img\"></div>";
				$data.= "<div class=\"info\">";
				$data.= "<div class=\"separator clear-left\">";
				$data.= "<p class=\"btn-add\"><a href=\"javascript:setcover(".$gall_id.",'".$prodid."');\" class=\"hidden-sm\">$iscover Cover</a></p>";
				$data.= "<p class=\"btn-details\"><a href=\"javascript:delImggall(".$gall_id.",'".$prodid."');\" class=\"hidden-sm\">ลบ</a></p>";
				$data.= "</div>";
				$data.= "<div class=\"clearfix\"></div>";
				$data.= "</div>";
				$data.= "</div>";
				$data.= "</div>";
				$arr[] = $data;
			}
		}

		$respon = "";
		$respon.= implode('',$arr);
		$respon.= "<div class=\"col-xs-12 col-sm-6 col-md-3 pd-x-5 pd-y-5\">";
		$respon.= "<div class=\"col-item rounded\" onclick=\"clickFle();\"
		style=\"cursor:pointer;border:2px dotted #555;background-image:url($url/images/uploadimg.jpg);background-position: center center;background-repeat: no-repeat;background-size: cover;\">";
		$respon.= "<div class=\"col-img\"></div>";
		$respon.= "</div>";
		$respon.= "</div>";
		echo json_encode(array('id'=>$prodid,'dataimg'=>$respon));
	}
	// ========================================================================//

	public function delImggall(){
		$id = $_REQUEST['id'];
		$gallid = $_REQUEST['gallid'];

		if(!empty($id)){
			$del = $this->delrow("kp_products_img","where id = '{$gallid}' and prodid  = '{$id}' ");
		}

		if($del===TRUE){
			$respon['status'] = "success";
			$respon['msg'] = "Delete Images Success!";
			$respon['id'] = $id;
		}else{
			$respon['status'] = "fail";
			$respon['msg'] = "Delete Images fail!";
			$respon['id'] = $id;
		}
		echo json_encode($respon);

	}
	// ========================================================================//
	// ========================================================================//
	// ========================================================================//
	// ========================================================================//

	public function sortMax($tb,$fill,$whereid){
		include "common/include/config.php";

		$sql = "select MAX($fill) as maxsort from $tb  $whereid ";
		$q = $dbCon->query($sql) or die($dbCon->error);
		$res = $q->fetch_object();

		return $res->maxsort+1;
	}

	public function countdatasort($fill,$tb){
		include "common/include/config.php";
		$qr = $dbCon->query("select MAX($fill)+1 as maxnumber from $tb") or die($dbCon->error);
		$res = $qr->fetch_object();
		$maxsort_number = $res->maxnumber;

		return $maxsort_number;
	}

	//end function sort


	// ========================================================================//
	// ========================================================================//
	// ========================================================================//
	// ========================================================================//

	// =============== begin manage document ===================== //
	public function loaddataDocument(){
		$arr = array();
		$urlweb = curPageURLweb();
		include "common/include/config.php";
		$requestData= $_GET;
		$id = $requestData['prodid'];

		$proddatasheet = $this->getTextformid('kp_products','proddatasheet','prodid',$id);
		$respon = "<a href='$urlweb/products-datasheet/$proddatasheet' target='_blank'>$proddatasheet</a>";
		$respon.= "<button type=\"button\" onclick=\"delDocument('$id');\" class=\"btn btn-sm btn-danger\"> ลบ </button>";
		echo json_encode($respon);
	}

	public function addDocument(){
		$readData = $_REQUEST;
		$prodid = $readData['prodid'];
		$prodname= $this->getTextformid("kp_products","prodname_th","prodid",$prodid);
		// $doc_name = $prodid.'-'.str_replace(' ','_',$_FILES["doc_file"]["name"]);
		$doc_name = $prodid.'-'.time().'.'.substr($_FILES["doc_file"]["name"],-3,3);
		if(move_uploaded_file($_FILES["doc_file"]["tmp_name"],"../products-datasheet/".$doc_name))
		{
				$form_array = array(
					'proddatasheet'=>$doc_name
				);

				$insert = $this->updaterow("kp_products",$form_array,"where prodid = '$prodid' ");
		}

		if($insert===TRUE){
			//start function save log transection
			$desclog = "เพิ่ม Document Datasheet $doc_name ในสินค้า $prodname";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['msg'] = "เพิ่ม Document Datasheet $doc_name ในสินค้า $prodname สำเร็จ!";
			$respon['id'] = $prodid;
		}else{
			$respon['status'] = "error";
			$respon['msg'] = "ไม่สามารถ เพิ่ม Document Datasheet $doc_name ในสินค้า $prodname สำเร็จ  กรุณาติดต่อ Support";
			$respon['id'] = $prodid;
		}
		echo json_encode($respon);
	}

	public function delDocument(){
		$readData = $_REQUEST;
		$id = $readData['id'];
		$prodname= $this->getTextformid("kp_products","prodname_th","prodid",$id);
		$docname = $this->getTextformid("kp_products","proddatasheet","prodid",$id);

		if($id){
			$del = $this->updaterow("kp_products",array('proddatasheet'=>''),"where prodid = '{$id}' ");
		}

		if($del===TRUE){
			//start function save log transection
			$desclog = "ลบ [Datasheet] ชื่อ $docname จากสินค้า $prodname";
			savelog(getSession(),$desclog);
			//end function save log transection

			$respon['status'] = "success";
			$respon['respontext'] = "Delete [Datasheet] ชื่อ $docname จากสินค้า $prodname success!";
			$respon['msg'] = "ลบ [Datasheet] ชื่อ $docname จากสินค้า $prodname สำเร็จ!";
			$respon['id'] = $prodid;
		}else{
			$respon['status'] = "error";
			$respon['respontext'] = "Delete [Datasheet] ชื่อ $docname จากสินค้า $prodname error!";
			$respon['msg'] = "ไม่สามารถ ลบ [Datasheet] ชื่อ $docname จากสินค้า $prodname สำเร็จ  กรุณาติดต่อ Support";
			$respon['id'] = $prodid;
		}

		echo json_encode($respon);
	}
	// =============== end manage document ===================== //


	// ========================================================================//
	// ========================================================================//
	public function cloneItem(){
		include "common/include/config.php";
		$readData = $_POST;
		$id = $readData['id'];

		$dbCon->begin_transaction();

		$qr = $this->fetchdata("kp_products","where prodid='{$id}' ");
		$res = $qr->fetch_assoc();
		$prodid = $this->countRowid($res['prodid']);
		$data['prodid'] = $prodid;
		$data['prodcode'] = $res['prodcode'];
		$data['slug'] = $res['slug'];
		$data['prodname_th'] = addslashes($res['prodname_th']);
		$data['prodname_en'] = addslashes($res['prodname_en']);
		$data['prodprice'] = $res['prodprice'];
		$data['prodprice_promotion'] = $res['prodprice_promotion'];
		$data['prodshortdetail_th'] = addslashes($res['prodshortdetail_th']);
		$data['prodshortdetail_en'] = addslashes($res['prodshortdetail_en']);
		$data['proddetail_th'] = addslashes($res['proddetail_th']);
		$data['proddetail_en'] = addslashes($res['proddetail_en']);
		$data['proddatasheet'] = $res['proddatasheet'];
		$data['prodlink'] = $res['prodlink'];
		$data['prodtag'] = $res['prodtag'];
		$data['cat_id'] = $res['cat_id'];
		$data['brand_id'] = $res['brand_id'];
		$data['qty'] = $res['qty'];
		$data['prodstatus'] = $res['prodstatus'];
		$data['prodtype'] = $res['prodtype'];
		$data['is_delete'] = $res['is_delete'];
		$data['status'] = $res['status'];
		$data['rating'] = 0;
		$data['seo_title'] = addslashes($res['seo_title']);
		$data['seo_desc'] = addslashes($res['seo_desc']);
		$data['user_create'] = getSession();
		$data['is_shipping'] = $res['is_shipping'];
		$data['shipping_amount'] = $res['shipping_amount'];
		$this->insertrow("kp_products",$data);

		$prodimg = $this->fetchdata("kp_products_img","where prodid = '{$id}' order by id asc");
		while($resimg = $prodimg->fetch_assoc()){
			$dataimg['prodid'] = $prodid;
			$dataimg['prodimg'] = $resimg['prodimg'];
			$dataimg['is_cover'] = $resimg['is_cover'];
			$dataimg['sort'] = $resimg['sort'];
			$this->insertrow("kp_products_img",$dataimg);
		}

		$prodoption = $this->fetchdata("kp_products_options","where prodid = '{$id}' order by id asc");
		while($resoption = $prodoption->fetch_assoc()){
			$dataoption['option_name'] = $resoption['desc_text'];
			$dataoption['option_value'] = $resoption['desc_code'];
			$dataoption['prodid'] = $prodid;
			$this->insertrow("kp_products_options",$dataoption);
		}

		$prodoptionlist = $this->fetchdata("kp_products_options_lists","where prodid = '{$id}' order by id asc");
		while($resoptionlist = $prodoptionlist->fetch_assoc()){
			$dataoptionlist['option_1'] = $resoptionlist['option_1'];
			$dataoptionlist['option_2'] = $resoptionlist['option_2'];
			$dataoptionlist['option_3'] = $resoptionlist['option_3'];
			$dataoptionlist['option_4'] = $resoptionlist['option_4'];
			$dataoptionlist['option_5'] = $resoptionlist['option_5'];
			$dataoptionlist['qty'] = $resoptionlist['qty'];
			$dataoptionlist['price'] = $resoptionlist['price'];
			$dataoptionlist['sku'] = $resoptionlist['sku'];
			$dataoptionlist['prodid'] = $prodid;
			$this->insertrow("kp_products_options_lists",$dataoptionlist);
		}

		$commit = $dbCon->commit();

		if($commit){
			//start function save log transection
			$desclog = "Clone Data {$res['prodname_th']} ";
			savelog(getSession(),$desclog);
			//end function save log transection

			$output['status'] = 'success';
			$output['msgtitle'] = 'Clone Data Success!';
			$output['msg'] = "คัดลอกรายการ {$res['prodname_th']} สำเร็จ";
		}else{
			$output['status'] = 'fail';
			$output['msgtitle'] = 'Clone Data fail!';
			$output['msg'] = "คัดลอกรายการ {$res['prodname_th']} ไม่สำเร็จ";
		}

		echo json_encode($output);
	}

	public function countRowid($id){
		include "common/include/config.php";
		$id = SUBSTR($id,0,6);
		$qr= $dbCon->query("select count(*) as countrow from kp_products where substr(prodid,1,6) = '{$id}' ") or die($dbCon->error);
		$res = $qr->fetch_assoc();

		return $id.'-'.$res['countrow'];
	}
	// ========================================================================//
	// ========================================================================//

}
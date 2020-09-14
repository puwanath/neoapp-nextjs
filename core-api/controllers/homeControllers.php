<?php
$param = "home";
require "models/{$param}.php";

class homeController extends Controllers
{
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$uri = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$param = "home";
		$model = new homeController;


		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
		if($select!=''):
		switch($select){

			case 'getseo' :
				 $model->getSeo();
				 break;			
				 
			case 'getcontactinfo' :
				 $model->getContactinfo();
				 break;

			case 'getbanner' :
				 $model->getBannerslide();
				 break;

			case 'getcategory' :
				 $model->getCategory();
				 break;

			case 'getsuppliers' :
				 $model->getSuppliers();
				 break;

			case 'getapplication' :
				 $model->getApplication();
				 break;

			case 'getprocess' :
				 $model->getProcess();
				 break;

			case 'getproducts' :
				 $model->getProducts();
				 break;

			case 'getposts' :
				 $model->getPosts();
				 break;

			default :
			$urlredirec = "../welcome";
			echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$urlredirec.'">';
			exit();
		}

		endif;

	}

	public function getSeo(){
		$qr = $this->fetchdata("kp_seo","where id=1 ");
		$res = $qr->fetch_assoc();

		$output['seotitle'] = $res['seotitle'];
		$output['seodesc'] = $res['seodesc'];
		$output['seokeyword'] = $res['seokeyword'];
		$output['google_id'] = $res['google_id'];
		$output['google_doamin'] = $res['google_domain'];
		echo json_encode($output);
	}


	public function getBannerslide(){
		$url = curPageURL();
		$qr = $this->fetchdata("kp_banner_slide","where status=1 and is_delete=0 order by sort asc limit 0,5 ");
		while($res = $qr->fetch_assoc()){
			$data['slide_id'] = $res['slide_id'];
			$data['slide_name_th'] = $res['slide_name_th'];
			$data['slide_name_en'] = $res['slide_name_en'];
			$data['slide_detail_th'] = $res['slide_detail_th'];
			$data['slide_detail_en'] = $res['slide_detail_en'];
			$data['slide_position_x'] = $res['slide_position_x'];
			$data['slide_position_y'] = $res['slide_position_y'];
			$data['slide_img'] = "{$url}/images/{$res['slide_img']}";
			$data['slide_img_tablet'] = "{$url}/images/{$res['slide_img_tablet']}";
			$data['slide_img_mobile'] = "{$url}/images/{$res['slide_img_mobile']}";

			$output[] = $data;
		}

		echo json_encode($output);
	}


	public function getContactinfo(){
		$url = curPageURL();
		$qr = $this->fetchdata("kp_contact_info","where id='1' ");
		$res = $qr->fetch_assoc();

		$output['contact_name_th'] = $res['contact_name_th'];
		$output['contact_name_en'] = $res['contact_name_en'];
		$output['contact_address_th'] = $res['contact_address_th'];
		$output['contact_address_en'] = $res['contact_address_en'];
		$output['contact_tel_th'] = $res['contact_tel_th'];
		$output['contact_tel_en'] = $res['contact_tel_en'];
		$output['contact_fax'] = $res['contact_fax'];
		$output['contact_email'] = $res['contact_email'];
		$output['contact_lineid'] = $res['contact_lineid'];
		$output['contact_facebook'] = $res['contact_facebook'];
		$output['contact_facebook_chat'] = $res['contact_facebook_chat'];
		$output['contact_website'] = $res['contact_website'];
		$output['contact_location_name'] = $res['contact_location_name'];

		
		echo json_encode($output);
	}

	public function getCategory(){
		$id = $_POST['id'];
		if($id){
			$qr = $this->fetchdata("kp_products_category","where  cat_id_main='{$id}' and status=1 and is_delete=0 and is_show=1");
			while($res = $qr->fetch_assoc()){
				$row['cat_id'] = $res['cat_id'];
				$row['cat_id_main'] = $res['cat_id_main'];
				$row['cat_name_th'] = $res['cat_name_th'];
				$row['cat_name_en'] = $res['cat_name_en'];
				$row['cat_detail_th'] = $res['cat_detail_th'];
				$row['cat_detail_en'] = $res['cat_detail_en'];
				$row['cat_slug'] = $res['cat_slug'];
				$row['cat_img'] = $res['cat_img'];
				$row['seo_title'] = $res['seo_title'];
				$row['seo_desc'] = $res['seo_desc'];
				$row['seo_keyword'] = $res['seo_keyword'];
				$output[] = $row;
			}
			echo json_encode($output);
		}else{
			$qr = $this->fetchdata("kp_products_category","where status=1 and is_delete=0 and is_show=1");
			while($res = $qr->fetch_assoc()){
				$row['cat_id'] = $res['cat_id'];
				$row['cat_id_main'] = $res['cat_id_main'];
				$row['cat_name_th'] = $res['cat_name_th'];
				$row['cat_name_en'] = $res['cat_name_en'];
				$row['cat_detail_th'] = $res['cat_detail_th'];
				$row['cat_detail_en'] = $res['cat_detail_en'];
				$row['cat_slug'] = $res['cat_slug'];
				$row['cat_img'] = $res['cat_img'];
				$row['seo_title'] = $res['seo_title'];
				$row['seo_desc'] = $res['seo_desc'];
				$row['seo_keyword'] = $res['seo_keyword'];
				$output[] = $row;
			}
			echo json_encode($output);
		}
	}

	public function getSuppliers(){
		$id = $_POST['id'];
		$url = curPageURL();
		if($id){
			$qr = $this->fetchdata("kp_products_suppliers","where supp_id = '{$id}' and status=1 and is_delete=0 order by sort asc");
			while($res = $qr->fetch_assoc()){
				$row['supp_id'] = $res['supp_id'];
				$row['supp_name_th'] = $res['supp_name_th'];
				$row['supp_name_en'] = $res['supp_name_en'];
				$row['supp_img'] = "{$url}/{$res['supp_img']}";
				$row['supp_detail_th'] = $res['supp_detail_th'];
				$row['supp_detail_en'] = $res['supp_detail_en'];
				$row['slug'] = $res['slug'];
				$output[] = $row;
			}

			echo json_encode($output);
		}else{
			$qr = $this->fetchdata("kp_products_suppliers","where status=1 and is_delete=0 order by sort asc");
			while($res = $qr->fetch_assoc()){
				$row['supp_id'] = $res['supp_id'];
				$row['supp_name_th'] = $res['supp_name_th'];
				$row['supp_name_en'] = $res['supp_name_en'];
				$row['supp_img'] = "{$url}/{$res['supp_img']}";
				$row['supp_detail_th'] = $res['supp_detail_th'];
				$row['supp_detail_en'] = $res['supp_detail_en'];
				$row['slug'] = $res['slug'];
				$output[] = $row;
			}

			echo json_encode($output);
		}
	}

	public function getApplication(){

	}

	public function getProcess(){

	}

	public function getProducts(){

	}

	public function getPosts(){

	}


// end class
}
?>

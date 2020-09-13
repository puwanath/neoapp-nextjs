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

			case 'getbanner' :
				 $model->getBannerslide();
				 break;

			default :
			$urlredirec = "../welcome";
			echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$urlredirec.'">';
			exit();
		}

		endif;

	}

	public function loadDataSlide(){
		$url = curPageURL();
		$word = new word();






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


// end class
}
?>

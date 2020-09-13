<?php
$param = "download";
require "models/$param.php";

class downloadController extends Controllers
{
	public function index($get_part0,$get_part1,$get_part2,$get_part3){
		$dir= curPageURL()."/assets/";
		$word = new word();
		$url = curPageURL();
		$uri = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		$pagename = $word->wordvar("download");
		$bgcover = "$url/images/bgabout.jpg";
		$param = "download";
		$model = new downloadController;

		$current_home = "active";
		$title = getseo('seotitle');
		$description = getseo('seodesc');
		$keyword = getseo('seokeyword');
		$urlweb = getcomp('url');
		$imageurl = "$url2/images/logo.png";

		//content detail
		$content = array(
		"views/$param/index.php"
		);
		//end content

		$page = include("views/layout/template.php");
		return $page;
	}


	public function loadData(){
		$word =new word();
		$url = curPageURL();
		$arr = array();
		$qr = $this->fetchdata("kp_filedownload","where status = 1 order by file_sort asc");
		while($res = $qr->fetch_object()){
			if($_SESSION['lg']=='TH'){
				$filename = $res->file_name_th;

			}else{
				$filename = $res->file_name_en;
			}
			$i++;
			$linkdownload = "$url/images/filesdownload/$res->file_tmp";
			$btndownload = "<a href=\"$linkdownload\" class=\"btn btn-primary btn-sm\" target=\"_blank\">".$word->wordvar('Download')."</a>";
			$data = "<tr>";
				$data.= "<td scope=\"row\" class=\"text-center\">$i</td>";
				$data.= "<td scope=\"row\" class=\"text-left\">$filename</td>";
				$data.= "<td scope=\"row\" class=\"text-center\">$btndownload</td>";
			$data.= "</tr>";
			array_push($arr,$data);
		}

		if(count($arr)>0){
				// $datahtml = "<div class=\"tt-block-title text-left\" style=\"padding-bottom:20px;\">";
				// 	$datahtml.= "<h1 class=\"tt-title project-headblog\">".$word->wordvar('Download')."</h1>";
				// $datahtml.= "</div>";
				// $datahtml = "<div class=\"row\">";
					$datahtml.= "<div class=\"col-md-12 col-xs-12\">";
					$datahtml.= "<div style=\"margin-top:10px;width:100%;overflow:auto;\">";
						$datahtml.= "<table class=\"table-download\" style=\"width:100%;\">";
							$datahtml.= "<thead class=\"thead-dark\">";
								$datahtml.= "<tr>
									<th scope=\"col\" class=\"text-center\" style=\"width:10%;\">".$word->wordvar('No')."</th>
									<th scope=\"col\" class=\"text-center\" style=\"width:70%;\">".$word->wordvar('File Name')."</th>
									<th scope=\"col\" class=\"text-center\" style=\"width:20%;\">".$word->wordvar('Download')."</th>
								</tr>";
							$datahtml.= "</thead>";
							$datahtml.= "<tbody>";
								$datahtml.= implode('',$arr);
							$datahtml.= "</tbody>";
						$datahtml.= "</table>";
					$datahtml.= "</div>";
					$datahtml.= "</div>";
				// $datahtml.= "</div>";
				return $datahtml;
		}
	}


	public function getData($id,$fillpage){
		$qr = $this->fetchdata("kp_page","where slang = '$id'");
		$res = $qr->fetch_object();
		if($fillpage=="pagename"):
		if($_SESSION['lg']=="TH"):return $res->pagename;else: return $res->pagename_en;endif;
		endif;
		if($fillpage=="pagedetail"):
		if($_SESSION['lg']=="TH"):return $res->pagedetail;else: return $res->pagedetail_en;endif;
		endif;
	}


}
?>

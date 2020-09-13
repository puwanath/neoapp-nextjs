<?php
// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า
function page_navigator($before_p,$plus_p,$total,$total_p,$chk_page,$keyword){
	global $urlquery_str;
	$pPrev=$chk_page-1;
	$pPrev=($pPrev>=0)?$pPrev:0;
	$pNext=$chk_page+1;
	$pNext=($pNext>=$total_p)?$total_p-1:$pNext;
	$lt_page=$total_p-4;
	$txtkeyword = $keyword;

	$page_btn = "";
	if($chk_page>0){
		 $page_btn.= "<a  href='$self?keyword=$txtkeyword&s_page=$pPrev' class='tg-prevpage'><i class='fa fa-chevron-left'></i></a>";
	}
	if($total_p>=11){
		if($chk_page>=4){
			$page_btn.= "<a $nClass href='$self?keyword=$txtkeyword&s_page=0'>1</a><a class='SpaceC'>. . .</a>";
		}
		if($chk_page<4){
			for($i=0;$i<$total_p;$i++){
				$nClass=($chk_page==$i)?"class='current-page'":"";
				if($i<=4){
				$page_btn.= "<a $nClass href='$self?keyword=$txtkeyword&s_page=$i'>".intval($i+1)."</a> ";
				}
				if($i==$total_p-1 ){
				$page_btn.= "<a>. . .</a><a $nClass href='$self?keyword=$txtkeyword&s_page=$i'>".intval($i+1)."</a> ";
				}
			}
		}
		if($chk_page>=4 && $chk_page<$lt_page){
			$st_page=$chk_page-3;
			for($i=1;$i<=5;$i++){
				$nClass=($chk_page==($st_page+$i))?"class='current-page'":"";
				$page_btn.= "<a $nClass href='$self?keyword=$txtkeyword&s_page=".intval($st_page+$i)."'>".intval($st_page+$i+1)."</a> ";
			}
			for($i=0;$i<$total_p;$i++){
				if($i==$total_p-1 ){
				$nClass=($chk_page==$i)?"class='current-page'":"";
				$page_btn.= "<a>. . .</a><a $nClass href='$self?keyword=$txtkeyword&s_page=$i'>".intval($i+1)."</a> ";
				}
			}
		}
		if($chk_page>=$lt_page){
			for($i=0;$i<=4;$i++){
				$nClass=($chk_page==($lt_page+$i-1))?"class='current-page'":"";
				$page_btn.= "<a $nClass href='$self?keyword=$txtkeyword&s_page=".intval($lt_page+$i-1)."'>".intval($lt_page+$i)."</a> ";
			}
		}
	}else{
		for($i=0;$i<$total_p;$i++){
			$nClass=($chk_page==$i)?"class='current-page'":"";
			$page_btn.= "<a href='$self?keyword=$txtkeyword&s_page=$i' $nClass  >".intval($i+1)."</a> ";
		}
	}
	if($chk_page<$total_p-1){
		$page_btn.= "<a href='$self?keyword=$txtkeyword&s_page=$pNext'  class='next-page'><i class='fa fa-chevron-right'></i></a>";
	}

	return $page_btn;
}


?>

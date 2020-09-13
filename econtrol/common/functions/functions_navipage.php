<?php
// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า
function page_navigator($before_p,$plus_p,$total,$total_p,$chk_page){
	global $urlquery_str;
	$pPrev=$chk_page-1;
	$pPrev=($pPrev>=0)?$pPrev:0;
	$pNext=$chk_page+1;
	$pNext=($pNext>=$total_p)?$total_p-1:$pNext;
	$lt_page=$total_p-4;
	$txtkeyword = $_GET['sa'];
	if($chk_page>0){
		return "<li><a  href='$self?keyword=$txtkeyword&s_page=$pPrev' class='tg-prevpage'><i class='fa fa-chevron-left'></i></a></li>";
	}
	if($total_p>=11){
		if($chk_page>=4){
			return "<li><a $nClass href='$self?keyword=$txtkeyword&s_page=0'>1</a><a class='SpaceC'>. . .</a></li>";
		}
		if($chk_page<4){
			for($i=0;$i<$total_p;$i++){
				$nClass=($chk_page==$i)?"class='active'":"";
				if($i<=4){
				return "<li><a $nClass href='$self?keyword=$txtkeyword&s_page=$i'>".intval($i+1)."</a></li> ";
				}
				if($i==$total_p-1 ){
				return "<li><a>. . .</a><a $nClass href='$self?keyword=$txtkeyword&s_page=$i'>".intval($i+1)."</a></li> ";
				}
			}
		}
		if($chk_page>=4 && $chk_page<$lt_page){
			$st_page=$chk_page-3;
			for($i=1;$i<=5;$i++){
				$nClass=($chk_page==($st_page+$i))?"class='active'":"";
				return "<li><a $nClass href='$self?keyword=$txtkeyword&s_page=".intval($st_page+$i)."'>".intval($st_page+$i+1)."</a></li> ";
			}
			for($i=0;$i<$total_p;$i++){
				if($i==$total_p-1 ){
				$nClass=($chk_page==$i)?"class='active'":"";
				return "<li><a>. . .</a><a $nClass href='$self?keyword=$txtkeyword&s_page=$i'>".intval($i+1)."</a></li> ";
				}
			}
		}
		if($chk_page>=$lt_page){
			for($i=0;$i<=4;$i++){
				$nClass=($chk_page==($lt_page+$i-1))?"class='active'":"";
				return "<li><a $nClass href='$self?keyword=$txtkeyword&s_page=".intval($lt_page+$i-1)."'>".intval($lt_page+$i)."</a></li> ";
			}
		}
	}else{
		for($i=0;$i<$total_p;$i++){
			$nClass=($chk_page==$i)?"class='active'":"";
			return "<li><a href='$self?keyword=$txtkeyword&s_page=$i' $nClass  >".intval($i+1)."</a></li> ";
		}
	}
	if($chk_page<$total_p-1){
		return "<li><a href='$self?keyword=$txtkeyword&s_page=$pNext'  class='tg-nextpage'><i class='fa fa-chevron-right'></i></a></li>";
	}
}


?>

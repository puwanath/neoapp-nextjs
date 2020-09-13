<?php
class word{
	public function wordvar($txt){

		$lg = $_SESSION['lg'];
		require 'econtrol/common/include/config.php';
		$text = addslashes($txt);
		$q = $dbCon->query("select * from kp_wordvar where word_en = '$text' ") or die($dbCon->error);
		$num = $q->num_rows;
		$re = $q->fetch_object();

		if($lg=="TH"):
			if($num>0):
				return $re->word_th;
			else:
				return $txt;
			endif;
		elseif($lg=="JP"):
			if($num>0):
				return $re->word_jp;
			else:
				return $txt;
			endif;
		else:
			return $txt;
		endif;

	}
}
?>

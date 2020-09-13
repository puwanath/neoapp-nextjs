<?php
class Controllers
{
	public function NewID($prefix,$fill,$tb)
	{
		include "common/include/config.php";
		$qr = $dbCon->query("select MAX(substr($fill,-4))+1 as MaxID from $tb") or die($dbCon->error);
		$res = $qr->fetch_object();
		$new_id = $res->MaxID;


		$y = date("y")+43;
		if($new_id==''){
			$idnew = "$prefix"."0001";
		}else{
			$idnew="$prefix".sprintf("%04d",$new_id);//ถ้าไม่ใช่ค่าว่าง
		}

        $dbCon->close();
        return $idnew;
	}

	public function fetchdata($tbname,$where){
		include "common/include/config.php";

		$sql = "select * from $tbname $where";
		$q = $dbCon->query($sql) or die($dbCon->error);

		return $q;
	}


	public function getTextformid($table,$getfill,$whereid,$id){
		include "common/include/config.php";
		$sql = "select $getfill as textfill from $table where $whereid = '".$id."' ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$res = $qr->fetch_object();

		return $res->textfill;
	}

	public function getTextfromwhere($table,$getfill,$where=''){
		include "common/include/config.php";
		$sql = "select $getfill as textfill from $table $whereid ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$res = $qr->fetch_object();

		return $res->textfill;
	}

	public function countrepair($id){
		include "common/include/config.php";

		$sql = "select count(*) as cc from kp_job where dv_id = '$id' ";
		$q = $dbCon->query($sql) or die($dbCon->error);
		$res = $q->fetch_object();

		return $res->cc;
	}

	public function getbrandname($id){
		include "common/include/config.php";

		$sql = "select * from kp_brand where brand_code = '$id' ";
		$q = $dbCon->query($sql) or die($dbCon->error);
		$res = $q->fetch_object();

		return $res->cat_name;
	}

	public function createby($id){
		include "common/include/config.php";

		$sql = "select * from kp_users where user_id = '$id' ";
		$q = $dbCon->query($sql) or die($dbCon->error);
		$res = $q->fetch_object();

		return $res->user_fullname.' '.$res->user_lastname;
	}

	public function sortMax($tb,$fill){
		include "common/include/config.php";

		$sql = "select MAX($fill) as maxsort from $tb";
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

	public function insertrow($table_name, $form_data)
	{
		include "common/include/config.php";
		// retrieve the keys of the array (column titles)
		$fields = array_keys($form_data);

		// build the query
		$sql = "INSERT INTO ".$table_name."
		(`".implode('`,`', $fields)."`)
		VALUES('".implode("','", $form_data)."')";

		// run and return the query result resource
		return $dbCon->query($sql);
	}

	public function delrow($table_name, $where_clause='')
	{
		include "common/include/config.php";
		// check for optional where clause
		$whereSQL = '';
		if(!empty($where_clause))
		{
			// check to see if the 'where' keyword exists
			if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
			{
				// not found, add keyword
				$whereSQL = " WHERE ".$where_clause;
			} else
			{
				$whereSQL = " ".trim($where_clause);
			}
		}
		// build the query
		$sql = "DELETE FROM ".$table_name.$whereSQL;

		// run and return the query result resource
		return $dbCon->query($sql);
	}

	public function updaterow($table_name, $form_data, $where_clause='')
	{
		include "common/include/config.php";
		// check for optional where clause
		$whereSQL = '';
		if(!empty($where_clause))
		{
			// check to see if the 'where' keyword exists
			if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
			{
				// not found, add key word
				$whereSQL = " WHERE ".$where_clause;
			} else
			{
				$whereSQL = " ".trim($where_clause);
			}
		}
		// start the actual SQL statement
		$sql = "UPDATE ".$table_name." SET ";

		// loop and build the column /
		$sets = array();
		foreach($form_data as $column => $value)
		{
			 $sets[] = "`".$column."` = '".$value."'";
		}
		$sql .= implode(', ', $sets);

		// append the where statement
		$sql .= $whereSQL;

		// run and return the query result
		return $dbCon->query($sql);
	}
}
?>

<?php
class Controllers
{
	function render_php($path)
	{
	    ob_start();
	    include($path);
	    $var=ob_get_contents();
	    ob_end_clean();
	    return $var;
	}

	public function fetchdata($tbname,$where){
		require 'econtrol/common/include/config.php';

		$sql = "select * from $tbname $where";
		$q = $dbCon->query($sql) or die($dbCon->error);

		return $q;
	}

	public function NewID($prefix,$fill,$tb)
	{
		include "econtrol/common/include/config.php";
		$qr = $dbCon->query("select MAX(substr($fill,-5))+1 as MaxID from $tb") or die($dbCon->error);
		$res = $qr->fetch_object();
		$new_id = $res->MaxID;


		$y = date("y")+43;
		if($new_id==''){
			$idnew = "$prefix".$y."00001";
		}else{
			$idnew="$prefix".$y.sprintf("%05d",$new_id);//ถ้าไม่ใช่ค่าว่าง
		}

        $dbCon->close();
        return $idnew;
	}

	public function insertrow($table_name, $form_data)
	{
		require 'econtrol/common/include/config.php';
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
		require 'econtrol/common/include/config.php';
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
		require 'econtrol/common/include/config.php';
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

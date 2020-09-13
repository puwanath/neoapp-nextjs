<?php
class Controllers
{

	public function fetchdata($tbname,$where){
		require 'econtrol/common/include/config.php';

		$sql = "select * from $tbname $where";
		$q = $dbCon->query($sql) or die($dbCon->error);

		return $q;
	}

	public function getTextformid($table,$getfill,$whereid,$id){
		include "econtrol/common/include/config.php";
		$sql = "select $getfill as textfill from $table where $whereid = '".$id."' ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$res = $qr->fetch_object();

		return $res->textfill;
	}

	public function getTextfromwhere($table,$getfill,$whereid){
		include "econtrol/common/include/config.php";
		$sql = "select $getfill as textfill from $table $whereid ";
		$qr = $dbCon->query($sql) or die($dbCon->error);
		$res = $qr->fetch_object();

		return $res->textfill;
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

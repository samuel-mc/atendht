<?php
class Admin
{

	const TABLE_USERS = "users";
	const TABLE_AUTH_USERS = "auth_users";
	const TABLE_COMPANIES = "companies";
	const TABLE_DELIVERIES = "deliveries";
	const TABLE_DELIVERY_DRUGS = "delivery_drugs";
	const TABLE_DELIVERY_STATUS = "delivery_status";
	const TABLE_DOCUMENTS = "documents";
	const TABLE_DRUGS = "drugs";
	const TABLE_DRUG_CONCENTRATION = "drug_concentrations";
	const TABLE_DRUG_NAMES = "drug_names";
	const TABLE_LOG = "log";
	const TABLE_PATIENTS = "patients";
	const TABLE_SUMMARY = "summary";
	const TABLE_SUMMARY_LOG = "summary_log";
	const TABLE_PROBLEMS = "problems";

	public $db;
	public $utils;
	public $query;

	function __construct()
	{
		require_once 'utils.php';
		require_once 'DB/connection.php';
		require_once 'DB/queryBuilder.php';
		require_once "session.php";
		$this->conn = new Connection;
		$this->utils = new Utils;
		$this->query = new QueryBuilder;
		$this->db = $this->conn->Connect();
	}

	public function GetLastId($table)
	{
		$query = $this->query->select("id", $table, "true", "id DESC");
		$q = $this->db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$q->execute();
		$row = $q->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
		$ultimo_id = $row[0];
		return $ultimo_id;
	}

	public function RunQuery($query)
	{
		$q = null;
		try {
			$q = $this->db->prepare($query);
			$q->execute();
		} catch (PDOException $error) {
			throw new PDOException('Mysql Resource failed: ' . $error->getMessage());
		}

		return $q;
	}

	public function Insert($table, $values, $return = null)
	{
		$res = array();
		$res['query'] = $this->query->insert($table, $values);
		if ($return == "query")
			return $res['query'];
		$this->RunQuery($res['query']);
		if ($return != null) {
			$res['id'] = $this->GetLastId($table);
			if ($return == "all") {
				$s = $this->query->select("*", $table, "id = " . $res['id']);
				$res['data'] = $this->GetFirst($s);
			} else {
			}
		}
		return $res;
	}

	public function Save($table, $values, $cond, $return = null)
	{
		$res = array();
		if (is_array($cond)) {
			$res['query'] = $this->query->update($table, $values, $cond[0] . " = " . $cond[1]);
		} else {
			$res['query'] = $this->query->update($table, $values, "id = " . $cond);
		}
		if ($return=="only_query")
			return $res['query'];
		$this->RunQuery($res['query']);
		return $res;
	}

	public function GetById($table, $id)
	{
		if ($id == null)
			return null;
		$select = $this->query->select("*", $table, "id = " . $id);
		return $this->GetFirst($select);
	}

	public function ViewList($table, $cond = 1, $order = "id")
	{
		$res = $this->query->select("*", $table, $cond,$order);
		$res = $this->GetAllRows($res);
		return $res;
	}

	public function GetFirst($select)
	{
		$res = $this->RunQuery($select);
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			return $row;
		}
	}

	public function GetAllRows($select)
	{
		$r = array();
		$res = $this->RunQuery($select);
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			$r[] = $row;
		}
		return $r;
	}

	public function Success($data)
	{
		return $data;
	}

	public function Error($data)
	{
		return ["success" => false, "data" => $data];
	}
}

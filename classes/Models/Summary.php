<?php
class Summary extends Admin
{

	public $logModel;

	function __construct()
	{
		parent::__construct();
		$this->logModel = new Log;
	}

	public function Create(Request $data)
	{
		$d = $data->extract(["drug_id", "quantity"]);
		$insert = $this->Insert(self::TABLE_SUMMARY, $d, "id");
		return $this->success($insert);
	}

	public function Read(Request $data)
	{
		return $this->success($this->GetById(self::TABLE_SUMMARY, $data->id));
	}

	public function Update(Request $data)
	{
		$d = $data->extract(["drug_id", "quantity"]);
		$update = $this->Save(self::TABLE_SUMMARY, $d, $data->id);
		return $this->success($update);
	}

	public function Delete(Request $data)
	{
		$delete = $this->Save(self::TABLE_SUMMARY, [
			"status" => 3
		], $data->id);
		return $this->success($delete);
	}

	public function List()
	{
		$this->logModel->Create(new Request(["type" => 1, "description" => "peticion para crear entrada", "data" => "Listando inventario"]));
		return $this->success($this->ViewList(self::TABLE_SUMMARY));
	}

	public function RegisterEntrance(Request $data)
	{
		$this->logModel->Create(new Request(["type" => 1, "description" => "peticion para crear entrada", "data" => json_encode($data->obj)]));
		session_start();
		$user_id = $_SESSION['user']['id'];
		$q = $data->get("quantity");
		$select = $this->query->select("*", self::TABLE_DRUGS, "lote = '" . $data->get("lote") . "'");
		$current = $this->GetFirst($select);
		if ($current == null) {
			$current = $this->Insert(self::TABLE_DRUGS, [
				"name_id" => $data->get("drug_id"),
				"concentration_id" => $data->get("concentration_id"),
				"lote" => $data->get("lote"),
				"expiration_date" => $data->get("expiration_date")
			], 'id');
			$summ = $this->Insert(self::TABLE_SUMMARY, [
				"drug_id" => $current['id'],
				"quantity" => $q
			], 'id');
		} else {
			$summ = $this->GetByDrugId($current['id']);
			$data->put("quantity", ($summ['quantity'] + $data->get("quantity")));
			$d = $data->extract(["quantity"]);
			$update = $this->Save(self::TABLE_SUMMARY, $d, ["drug_id", $current["id"]]);
		}
		$drug_id = $current['id'];
		$data->put("date", "CURRENT_TIMESTAMP()");
		$data->put("type", 1);
		$data->put("quantity", $q);
		$data->put("user_id", $user_id);
		$data->put("drug_id", $drug_id);
		$d = $data->extract(["quantity", "date", "type", "annexed", "user_id", "drug_id"]);
		$insert = $this->Insert(self::TABLE_SUMMARY_LOG, $d);
		$res = array();
		$res = $this->GetById(self::TABLE_DRUGS, $drug_id);
		$res['concentration'] = $this->GetById(self::TABLE_DRUG_CONCENTRATION, $data->get('concentration_id'));
		$res['summary'] = $this->GetByDrugId($res['id']);
		$res['name'] = $this->GetById(self::TABLE_DRUG_NAMES, $res['name_id']);

		return $this->success($res);
	}

	public function DeleteRegister(Request $req)
	{
		$sm_l = $this->GetById(self::TABLE_SUMMARY_LOG, $req->id);
		$sm = $this->GetByDrugId($sm_l['drug_id']);
		if ($sm_l['type']==2){
			$q = $sm['quantity'] + $sm_l['quantity'];
		}else{
			$q = $sm['quantity'] - $sm_l['quantity'];
		}
		$this->Save(self::TABLE_SUMMARY, ["quantity" => $q], $sm['id']);
		$update = $this->Save(self::TABLE_SUMMARY_LOG, ["drug_id" => 0], $req->id);
		return $this->success($update);
	}

	public function GetByDrugId($drug)
	{
		$select = $this->query->select("*", self::TABLE_SUMMARY, "drug_id = " . $drug);
		return $this->GetFirst($select);
	}

	public function GetLog(Request $data)
	{
		$f = "true";
		if ($data->get("type")!=0){
			$f = "type = ".$data->get("type");
		}
		$select = $this->query->select("*", self::TABLE_SUMMARY_LOG, " drug_id = " . $data->get('drug_id') . " AND ".$f,"date DESC");
		$res = array();
		foreach ($this->GetAllRows($select) as $r) {
			$r['drug'] = $this->GetById(self::TABLE_DRUGS, $r['drug_id']);
			$r['concentration'] = $this->GetById(self::TABLE_DRUG_CONCENTRATION, $r['drug']['concentration_id']);
			$r['name'] = $this->GetById(self::TABLE_DRUG_NAMES, $r['drug']['name_id']);
			$r['delivery'] = $this->GetById(self::TABLE_DELIVERIES,$r['delivery_id']);
			$res[] = $r;
		}
		return $this->success($res);
	}
}

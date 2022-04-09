<?php 
	class Patients extends Admin
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function Create(Request $data)
		{
			$d = $data->extract(["u_id","name","email","phone","address"]);
			$insert = $this->Insert(self::TABLE_PATIENTS,$d,"id");
			return $this->success($insert);
		}

		public function Read(Request $data)
		{
			return $this->success($this->GetById(self::TABLE_PATIENTS,$data->id));
		}

		public function Update(Request $data)
		{	
			$d = $data->extract(["u_id","name","email","phone","address"]);
			$update = $this->Save(self::TABLE_PATIENTS,$d,$data->id);
			return $this->success($update);
		}

		public function GetDeliveryHistory(Request $request)
		{
			$s = $this->query->select("*",self::TABLE_PATIENTS,"u_id = '".$request->get("u_id")."'");
			$user = $this->GetFirst($s);
			$s2 = $this->query->select("*",self::TABLE_DELIVERIES,"patient_id = ".$user['id']);
			$list =  $this->GetAllRows($s2);
			$res = array();
			foreach ($list as $del) {
				$drugs_names = "";
				$drugs_quantities = "";
				$drugs_concentrations = "";
				$sel_dr = $this->query->select("*",self::TABLE_DELIVERY_DRUGS,"delivery_id = ".$del['id']);
				$drugs = array();
				foreach ($this->GetAllRows($sel_dr) as $dr) {
					$d = $this->GetById(self::TABLE_DRUGS,$dr['drug_id']);
					$d['name'] = $this->GetById(self::TABLE_DRUG_NAMES,$d['name_id']);
					$d['concentration'] = $this->GetById(self::TABLE_DRUG_CONCENTRATION,$d['concentration_id']);
					$d['summary'] = $this->GetById(self::TABLE_SUMMARY,$dr['drug_id']);
					$d['quantity'] = $dr['quantity'];
					$drugs[] = $d;
					$drugs_names .= $d['name']['name']."/ ";
					$drugs_quantities .= $dr['quantity']."/ ";
					$drugs_concentrations .= $d['concentration']['name']."/ ";
				}


				$sel_docs = $this->query->select("*",self::TABLE_DOCUMENTS,"delivery_id = ".$del['id']);
				$del['documents'] = $this->GetAllRows($sel_docs);

				$sel_auth =  $this->query->select("*",self::TABLE_AUTH_USERS,"delivery_id = ".$del['id']);
				$del['auth_user'] = $this->GetFirst($sel_auth);
				$del["auth_user_name"]=  $del['auth_user']['name'];
				$del["auth_user_phone"]= $del['auth_user']['phone']; 

				$del['drugs'] = $drugs;

				$del['drugs_parse_names'] = $drugs_names;
				$del['drugs_parse_quantities'] = $drugs_quantities;
				$del['drugs_parse_concentrations'] = $drugs_concentrations;

				$del['patient'] = $this->GetById(self::TABLE_PATIENTS,$del['patient_id']);

				$del['patient_id'] = $del['patient']['id'];
				$del['patient_u_id'] = $del['patient']['u_id'];
				$del['patient_name'] = $del['patient']['name'];
				$del['patient_email'] = $del['patient']['email'];
				$del['patient_phone'] = $del['patient']['phone'];
				$del['patient_address'] = $del['patient']['address'];
				$del['patient_status'] = $del['patient']['status'];
				$res[]=$del;
			}

			return $this->success($res);
		}

		public function Delete(Request $data)
		{
			$delete = $this->Save(self::TABLE_PATIENTS,[
				"status"=>3
			],$data->id);
			return $this->success($delete);
		}

		public function List()
		{
			return $this->success($this->ViewList(self::TABLE_PATIENTS));
		}

		public function GetByUid(Request $data)
		{
			$select = $this->query->select("*",self::TABLE_PATIENTS,"u_id = '".$data->get("u_id")."'");
			return $this->success($this->GetFirst($select));
		}
	}

?>

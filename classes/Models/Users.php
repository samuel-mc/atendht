<?php  

	class Users extends Admin
	{
		public $logModel;
		
		function __construct()
		{
			parent::__construct();
			$this->logModel = new Log;
		}

		public function Create(Request $data)
		{
			$d = $data->extract(["name","email","phone","lastname","company_id"]);
			$user = $this->GetFirst($this->query->select("*",self::TABLE_USERS,"email = '".$data->get("email")."'"));
			if ($user!=null && $data->get("email")!=$user['email']){
				return ["success"=>false,"message"=>"Ya existe un usuario registrado con este correo"];
			}
			if ($data->id==null){
				$pass = md5($data->get("phone"));
				$d["password"] = $pass;
				$d["status"] = 4;
				$d["type"] = 1;
				if ($data->get("name")!=null){
					$usr = $this->Insert(self::TABLE_USERS,$d,"all");
					return ["success"=>true,"data"=>$usr['data']];
				}else{
					return ["success"=>false,""];
				}
			}else{
				$this->Save(self::TABLE_USERS,$d,$data->id);
				return ["success"=>true];
			}
		}

		public function Read(Request $data)
		{
			return $this->success($this->GetById(self::TABLE_USERS,$data->id));
		}

		public function Update(Request $data)
		{	
			$d = $data->extract(["name","email",["phone"=>"phone"],"type","company_id"]);
			$update = $this->Save(self::TABLE_USERS,$d,$data->id);
			return $this->success($update);
		}

		public function Delete(Request $data)
		{
			$delete = $this->Save(self::TABLE_USERS,[
				"status"=>3
			],$data->id);
			return $this->success($delete);
		}

		public function List()
		{
			$us = $this->ViewList(self::TABLE_USERS,"status != 3");
			$res = array();
			foreach ($us as $u) {
				$u['company'] = $this->GetById(self::TABLE_COMPANIES,$u['company_id'])['name'];
				$res[] = $u;
			}
			return $res;
		}


		public function Login($data)
		{
			$this->logModel->Create(new Request(["type"=>1,"description"=>"peticion a Users","data"=>json_encode($data->obj)]));
			$user = $this->query->select("*",self::TABLE_USERS,"email = '".$data->get('email')."' AND password = '".md5($data->get("password"))."' AND (status = 1 OR status = 4)");
			$user = $this->GetFirst($user);
			if ($user==null){
				return ["login"=>false,"message"=>"Datos incorrectos"];
			}else{
				if ($user["status"]!=4){
					$_SESSION['login'] = 1;
					$_SESSION['start'] = time();
					$user['pass'] = "Qué miras, puto";
					$user['password'] = $user['pass'];
					$_SESSION['token'] = "JASNDKJASBDKJASBKDBASKDJBASKJDBAKSJDBKJASDBJKASBDKJBASDASJKDBKAJSDBASJD";
				}
				if (session_status() !== PHP_SESSION_ACTIVE)
						session_start();
				$_SESSION['user'] = $user;
				$user['login'] = true;
				return $user;
			}
		}

		public function ChangePassword(Request $data)
		{
			if (session_status() !== PHP_SESSION_ACTIVE)
				session_start();
			$user_id = $_SESSION['user']['id'];
			$user = $this->GetFirst("SELECT * FROM ".self::TABLE_USERS." WHERE id = ".$user_id);
			$pass_md5 = md5($data->get("password"));
			$this->Save(self::TABLE_USERS,["password"=>$pass_md5,"status"=>1],$user_id);
			
			$_SESSION['login'] = 1;
			$_SESSION['start'] = time();
			$user['pass'] = "Qué miras, puto";
			$user['password'] = $user['pass'];
			return $user;
			return $data->obj;
		}



	}

?>
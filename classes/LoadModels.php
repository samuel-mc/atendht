<?php  
	class Model
	{
		public $companies;
		public $deliveries;
		public $documents;
		public $drugs;
		public $log;
		public $patients;
		public $summary;
		public $users;
		public $files;
		public $dhl;
		public $communication;
		public $problems;

		function __construct()
		{
			require "admin.php";
			require "Models/Companies.php";
			require "Models/Deliveries.php";
			require "Models/Documents.php";
			require "Models/Drugs.php";
			require "Models/Log.php";
			require "Models/Patients.php";
			require "Models/Summary.php";
			require "Models/Users.php";
			require "Models/Files.php";
			require "Models/DHL.php";
			require "Models/Communication.php";
			require "Models/Problems.php";
			$this->dhl = new DHL;
			$this->companies = new Companies;
			$this->deliveries = new Deliveries;
			$this->documents = new Documents;
			$this->drugs = new Drugs;
			$this->log = new Log;
			$this->patients = new Patients;
			$this->summary = new Summary;
			$this->users = new Users;
			$this->files = new Files;
			$this->communication = new Communication;
			$this->problems = new Problems;
		}
	}

?>
<?php 
class LDAPObject implements JsonSerializable
{
	private $customer = [];
	private $hostname = [];
	private $damcluster = [];
	
	function __construct($customer, $hostname, $damcluster)
	{
		$this->customer = $customer;
		$this->hostname = $hostname;
		$this->damcluster = $damcluster;
	}
	
	public function jsonSerialize()
	{
		return [
				'customer' => $this->customer,
				'hostname' => $this->hostname,
				'damcluster' => $this->damcluster
		];
	}
	public function getDisplayname(){
		return $this->customer;
	}
	public function setDisplayname($customer){
		$this->customer = $customer;
	}
}

?>
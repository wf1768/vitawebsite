<?php
class marking_model extends MY_Model{

	public $tableName= "v_marking";
	/**
	 * 构造函数
	 */
	public function __construct() {
		parent::__construct();
		log_message('debug', "marking_model Model Class Initialized");
	}


}
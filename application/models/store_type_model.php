<?php

class store_type_model extends MY_Model {

	public $tableName= "v_stores_type";
	/**
	 * 构造函数
	 */
	public function __construct() {
		parent::__construct();
		log_message('debug', "store_type_model Model Class Initialized");
	}
}
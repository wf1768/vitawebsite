<?php
class store_image_model extends MY_Model{

	public $tableName= "v_stores_image";

	/**
	 * 构造函数
	 */
	public function __construct() {
		parent::__construct();
		log_message('debug', "store_image_model Model Class Initialized");
	}


}
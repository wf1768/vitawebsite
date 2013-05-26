<?php
class history_image_model extends MY_Model{

	public $tableName= "v_history_image";

	/**
	 * 构造函数
	 */
	public function __construct() {
		parent::__construct();
		log_message('debug', "history_image_model Model Class Initialized");
	}


}
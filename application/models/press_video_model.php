<?php
class press_video_model extends MY_Model{

	public $tableName= "v_press_video";

	/**
	 * 构造函数
	 */
	public function __construct() {
		parent::__construct();
		log_message('debug', "press_video_model Model Class Initialized");
	}


}
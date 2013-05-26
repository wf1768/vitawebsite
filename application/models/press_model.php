<?php

class press_model extends MY_Model {

     public $tableName= "v_press";

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        log_message('debug', "press_model Model Class Initialized");
    }
}
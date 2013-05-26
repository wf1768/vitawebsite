<?php

class store_model extends MY_Model {

     public $tableName= "v_stores";

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        log_message('debug', "store_model Model Class Initialized");
    }
}
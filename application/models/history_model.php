<?php

class history_model extends MY_Model {

     public $tableName= "v_history";

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        log_message('debug', "history_model Model Class Initialized");
    }
}
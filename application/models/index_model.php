<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * website Controller Class
 *
 * 基于ci的 企业网站
 *
 * @package		website
 * @author		blues <blues0118@gmail.com>
 * @copyright	Copyright (c) 2013 - 2015, ussoft.net.
 * @license
 * @link
 * @version		0.1.0
 */

//=================================================

/**
 * index model Class
 *
 * 引导页 操作Model。
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class index_model extends MY_Model {

     public $tableName= "v_index";

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        log_message('debug', "index Model Class Initialized");
    }



}

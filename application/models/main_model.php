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
 * main model Class
 *
 * 首页 操作Model。
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class main_model extends MY_Model {

     public $tableName= "v_main";

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        log_message('debug', "main Model Class Initialized");
    }
}

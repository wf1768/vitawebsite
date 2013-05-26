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
 * config model Class
 *
 * 系统配置 操作Model。
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class config_model extends MY_Model {

     public $tableName= "v_sys_config";

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        log_message('debug', "sys_config Model Class Initialized");
    }
}

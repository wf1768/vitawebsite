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
 * website MY_Controller Class
 *
 * website 引导页。
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class home extends CI_Controller {

	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 */
	function __construct() {
		parent::__construct();
        $this->load->model('index_model');
        $this->_data['sys_title'] = '北京丰意德家具有限责任公司';
	}
	/**
	 * 转到引导页
	 */
	public function index() {
        $index = $this->index_model->getOne('1');
        if ($index) {
            $this->_data['index'] = $index;
            $this->load->view('website/home',$this->_data);
        }
        else {
            //如果没有找到怎么处理？
        }
	}

}

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
 * main MY_Controller Class
 *
 * website 关于我们。
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class marking extends CI_Controller {
   
	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('marking_model',"model");
		$this->_data['sys_title'] = '北京丰意德家具有限责任公司';
	}
	/**
	 * 转到引导页
	 */
	public function index() {
		//获取品牌logo列表,加入到_data中
		$data = $this->website_lib->product_info();
		$this->_data = array_merge($this->_data,$data);
		//获取首页轮播图片列表。
		$this->_data['list']=$this->model->getAllByWhere(array(),array(),array('sort'=>'asc'));
		$this->load->view('website/marking',$this->_data);
	}
	
}
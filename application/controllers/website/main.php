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
 * website 首页。
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class main extends CI_Controller {

	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 */
	function __construct() {
		parent::__construct();
        $this->load->model('main_model');
        $this->_data['sys_title'] = '北京丰意德家具有限责任公司';
	}
	/**
	 * 转到首页
	 */
	public function index() {

        //获取配置，首页采用图片或者视频模式
        $config = $this->website_lib->config('main_video');
        if ($config) {
            if ($config->value == '1') {
                //获取品牌logo列表,加入到_data中
                $data = $this->website_lib->product_info();
                $this->_data = array_merge($this->_data,$data);
                $this->load->view('website/main_video',$this->_data);
                return;
            }
        }
        //获取品牌logo列表,加入到_data中
        $data = $this->website_lib->product_info();
        $this->_data = array_merge($this->_data,$data);
        //获取首页轮播图片列表。
        $main = $this->main_model->getAllByWhere(array(),array(),array('sort'=>'asc'));
        $this->_data['main'] = $main;
        $this->load->view('website/main',$this->_data);

	}

}

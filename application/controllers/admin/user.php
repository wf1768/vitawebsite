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
 * 用户管理
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */
class user extends MY__Controller{
	//构造函数
	function __construct() {
		parent::__construct();
		$this->_data['sys_title'] = '北京丰意德家具有限责任公司-账户管理';
		$this->load->model('account_model');
		$this->_data['page_offset'] = 10;
		$this->_data['fun'] = 'user';
	}
	public function chkpwd(){
		$this->load->view("admin/chkpwd",$this->_data);
	}
	//首页
	public function index(){
		$this->chkpwd();
	}
	public function dochkpwd2(){
		print_r($_POST);
	}
	/**
	 * 执行数据修改项
	 * @access public
	 * @return mixed
	 */
	public  function dochkpwd(){
		$passwrod=trim($_POST['password']);
		$_POST['password']=Common::do_hash(trim($passwrod));
		$_POST['id']=1;
		$this->dataUpdate($this->account_model,$_POST,false);
		$this->auth_lib->logout();
	}
}
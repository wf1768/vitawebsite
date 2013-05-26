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
 * 后台登陆页。
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class login extends CI_Controller {

	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 * @access public
	 * @return void
	 */
	function __construct() {
		parent::__construct();

		$this->load->model('account_model');
		$this->load->library('auth_lib');
//		$this->load->library('config_lib');
//
//		$this->_data = $this->config_lib->load_sys_config(NULL);
//
//		$this->_data['page_title'] = "系统登陆";
//
//		//登陆页top菜单没有登陆时，不能显示模块菜单
//		$this->_data['topmenu'] = false;
        $this->_data['sys_title'] = '北京丰意德家具有限责任公司--后台登陆';
	}


	/**
	 * 转到登录页面
	 */
	public function index() {
		$this->load->view('admin/login',$this->_data);
	}

	/**
	 * 处理登录请求。
	 */
	public function accountLogin() {
		
		if(!$this->input->post("verify")){
			MY__Controller::error('请输入验证码');
		}elseif($this->session->userdata("verify") != md5($this->input->post("verify"))) {
            MY__Controller::error('验证码错误！');
		}else{
			//验证表单
			$this->form_validation->set_rules('accountcode', '帐户名', 'required|min_length[2]|trim');
			$this->form_validation->set_rules('password', '密码', 'required|trim');
			$this->form_validation->set_error_delimiters('<li>', '</li>');

			//如果表单验证没有通过，返回登陆页
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('admin/login', $this->_data);
			}
			else {

				//验证帐户和密码
				$accountcode = $this->input->post('accountcode',TRUE);
				$password = $this->input->post('password',TRUE);
				$account = $this->account_model->validate_account($accountcode,$password);
				if(!empty($account)) {
					//合法登录。session等
					if($this->auth_lib->login((array)$account)) {
						redirect('a/index');
					}
				}
				else {
					//延迟1秒
					sleep(1);
					$this->session->set_flashdata('login_error', 'TRUE');
					$this->_data['login_error_msg'] = '用户名或密码无效';

					$this->load->view('admin/login', $this->_data);
				}
			}
		}
	}

	/**
	 * 帐户退出
	 *
	 * @access public
	 * @return void
	 */
	public function logout() {
		$this->auth_lib->logout();
	}

	/**
	 * 获得验证码
	 *
	 * @access public
	 * @return void
	 */
	public function getVerify() {
		$this->load->library("Image");
		$this->load->library("String");
		$randval = String::randString(4, 1);
		$this->session->set_userdata("verify", md5($randval));
		Image ::buildImageVerify($length=4, $mode=1, $type='png', $width=68, $height=20, $verifyName='verify',$randval);
	}
}

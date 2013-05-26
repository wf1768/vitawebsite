<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * website Controller Class
 *
 * 基于ci的 企业网站
 *
 * @package             website
 * @author              blues <blues0118@gmail.com>
 * @copyright   Copyright (c) 2013 - 2015, ussoft.net.
 * @license
 * @link
 * @version             0.1.0
 */

//=================================================

/**
 * website MY_Controller Class
 *
 * 权限控制,控制帐户登陆和登出
 * @package             website
 * @subpackage  Controller
 * @category    Controller
 * @author              blues <blues0118@gmail.com>
 * @link
 */

class auth_lib {

    /**
     * 帐户
     * @var array
     */
    private $_account = array();

    /**
     * CI句柄
     *
     * @access private
     * @var object
     */
    private $_CI;

    /**
     * 构造函数
     */
    public function __construct()
    {
        date_default_timezone_set('PRC');
        /** 获取CI句柄 */
        $this->_CI = & get_instance();

        $this->_account = unserialize($this->_CI->session->userdata('account'));
        log_message('debug', "auth library Class Initialized");
    }

    /**
     * 判断帐户是否已经登录
     *
     * @access public
     * @return void
     */
    public function hasLogin() {
        $isLogin = false;
        /** 检查session */
        if (!empty($this->_account)) {
            $isLogin = true;
        }
        return $isLogin;
    }

    /**
     * 处理帐户登录.写登陆日志
     *
     * @access public
     * @param  array $account 帐户信息
     * @return boolean
     */
    public function login($account) {
        /** 获取帐户信息 */
        $this->_account = $account;
        $this->_set_session();
        return true;
    }
    // 获取客户端IP地址
    function get_client_ip() {
        static $ip = NULL;
        if ($ip !== NULL) return $ip;
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos =  array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip   =  trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $ip = (false !== ip2long($ip)) ? $ip : '0.0.0.0';
        return $ip;
    }
    /**
     * 设置session
     *
     * @access private
     * @return void
     */
    private function _set_session() {
        $session_data = array('account' => serialize($this->_account));
        $this->_CI->session->set_userdata($session_data);
    }

    /**
     * 处理帐户登出
     *
     * @access public
     * @return void
     */
    public function logout() {
        $this->_CI->session->sess_destroy();
        redirect('a/login');
    }
}

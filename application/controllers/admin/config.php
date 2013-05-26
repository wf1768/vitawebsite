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
 * 后台 config页
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class config extends MY__Controller {

	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 */
	function __construct() {
		parent::__construct();
        $this->_data['sys_title'] = '北京丰意德家具有限责任公司--系统配置';
        $this->load->model('config_model');
        $this->_data['fun'] = 'config';
        $this->_data['page_offset'] = 10;
	}


	/**
	 * 转到
	 */
	public function index() {
        $this->dataList('admin/config',$this->config_model,array(),array(),array(),$this->_data);
	}

    public function edit_status() {
        $result = false;
        $id = $this->input->post('id') ? $this->input->post('id') : '';
        $status = $this->input->post('status') ? $this->input->post('status') : '';


        if (!$id) {
            $this->output->append_output($result);
            return;
        }
        $update['id'] = $id;
        if (!$status) {
            $status = '0';
        }
        $update['value'] = $status;
        $num = $this->dataUpdate($this->config_model,$update,false);
        if ($num > 0) {
            $result = true;
        }
        $this->output->append_output($result);
    }

}

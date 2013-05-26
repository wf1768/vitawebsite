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
 * 后台 产品类别 控制器
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class product_type extends MY__Controller {

	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 */
	function __construct() {
		parent::__construct();
        $this->_data['sys_title'] = '北京丰意德家具有限责任公司--商品分类管理';
        $this->load->model('product_type_model');
        $this->_data['fun'] = 'product';

        $this->_data['page_offset'] = 10;
	}


	/**
	 * 转到登录页面
	 */
	public function index() {
        $this->dataList('admin/product_type',$this->product_type_model,array(),array(),array('sort'=>'asc'),$this->_data);
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
        $update['status'] = $status;
        $num = $this->dataUpdate($this->product_type_model,$update,false);
        if ($num > 0) {
            $result = true;
        }
        $this->output->append_output($result);
    }


}

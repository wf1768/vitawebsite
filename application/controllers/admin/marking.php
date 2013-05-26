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
 * 关于我们
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */
class marking extends MY__Controller{
	// 传递到对应视图的变量
	private $_data;
	//构造函数
	function __construct() {
		parent::__construct();
		$this->_data['sys_title'] = '北京丰意德家具有限责任公司-关于我们';
		$this->load->model('marking_model','image_model');
		$this->_data['page_offset'] = 10;
		$this->_data['fun'] = 'about';
		$this->img_upd_path='upload/about_marking';
	}
	//设置图片上传路径
	public function _getImgPath(){
		return  $this->img_upd_path;
	}
	//照片墙
	public function  markList(){
	    $this->dataList('admin/markList',$this->image_model,array(),array(),array('sort'=>'asc'),$this->_data);
	}
	public function edit_image() {
		$result = false;
		$id = $this->input->post('id') ? $this->input->post('id') : '';
		$sort = $this->input->post('sort') ? $this->input->post('sort') : '';
		$content = $this->input->post('content') ? $this->input->post('content') : '';
		if (!$id) {
			$this->output->append_output($result);
			return;
		}
		$update_image['id'] = $id;
		$update_image['sort'] = $sort;
		$update_image['content']=$content;
		$num = $this->dataUpdate($this->image_model,$update_image,false);
		if ($num > 0) {
			$result = true;
		}
		$this->output->append_output($result);
	}
}
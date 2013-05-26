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
class about extends MY__Controller{


	// 传递到对应视图的变量
	private $_data;
	//构造函数
	function __construct() {
		parent::__construct();
		$this->_data['sys_title'] = '北京丰意德家具有限责任公司-关于我们';
		$this->load->model('main_model');
		$this->load->model('history_model');
		$this->load->model('history_image_model','image_model');
		$this->_data['page_offset'] = 10;
		$this->_data['fun'] = 'about';
	}
	//设置图片上传路径
	public function _getImgPath(){
		return  $this->img_upd_path='upload/about';
	}
	//首页
	public function index(){
		$this->historyList();
	}
	//历史列表
	public function historyList(){
		$this->dataList("admin/historyList",$this->history_model, array(), array(),array(), $this->_data);
	}
	//添加关于我们 历史
	public function addYearContent(){
		$list=$this->history_model->getAllByWhere(array(),array("year"));
		foreach($list as $val) $this->_data['years'][]=$val->year;
		$this->load->view('admin/addHistory',$this->_data);
	}
	//执行添加历史
	public function doAddYearContent(){
		$this->dataInsert($this->history_model);
	}
	//历史图片列表
	public function historyPicList(){
		$this->dataList('admin/historyPicList',$this->image_model,array("historyid"),array(),array('sort'=>'asc'),$this->_data);
	}
	//修改历史
	public  function updHistory(){
		if(!trim($_GET['id'])) $this->error("非法调用");
		$info=$this->history_model->getOneBywhere(array("id"=>trim($_GET['id'])));
		if(!$info)   $this->error("非法调用");
		$this->_data['info']=$info;
		$this->load->view("admin/updHistory",$this->_data);
	}
	//执行修改历史信息
	public function doUpdHistory(){
		$this->dataUpdate($this->history_model);
	}
	//批量删除历史
	public function multDelHistory(){
		$result = false;
		$idList = $this->input->post('id') ? $this->input->post('id') : '';
		$idList = explode(',',$idList);
		if (empty($idList)) {
			$this->output->append_output($result);
			return;
		}
		//删除历史记录
		foreach($idList as $val){
			$list=$this->image_model->getAllByWhere(array("historyid"=>$val));
			foreach ($list as $row) {
				$oldpath = $row->imagepath;
				$result = $this->dataDelete($this->image_model,array('id'=>$row->id),'id',false);
				//检查文件是否存在
				if (file_exists($oldpath)) {
					//删除物理文件
					@unlink($oldpath);
				}
			}
			$result = $this->dataDelete($this->history_model,array('id'=>$val),'id',false);
		}
		$this->output->append_output($result);
	}
	//单个删除历史
	public function singleDelHistory(){
		$result = false;
		$id = $this->input->post('id') ? $this->input->post('id') : 0;
		if (!$id) {
			$this->output->append_output($result);
			return;
		}
		//读取原有数据，用来删除数据后，删除物理文件
		$list=$this->image_model->getAllByWhere(array("historyid"=>$id));
		foreach ($list as $row) {
			$oldpath = $row->imagepath;
			$result = $this->dataDelete($this->image_model,array('id'=>$row->id),'id',false);
			//检查文件是否存在
			if (file_exists($oldpath)) {
				//删除物理文件
				@unlink($oldpath);
			}
		}
		$result = $this->dataDelete($this->history_model,array('id'=>$id),'id',false);
		$this->output->append_output($result);
	}
}
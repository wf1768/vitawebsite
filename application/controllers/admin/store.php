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
 * 分店
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */
class store extends MY__Controller{


	// 传递到对应视图的变量
	private $_data;
	//构造函数
	function __construct() {
		parent::__construct();
		$this->_data['sys_title'] = '北京丰意德家具有限责任公司-分店';
		$this->load->model('main_model');
		$this->load->model('store_model');
		$this->load->model('store_type_model');
		$this->load->model('store_image_model','image_model');
		$this->_data['page_offset'] = 10;
		$this->_data['fun'] = 'store';
	}
	//设置图片上传路径
	public function _getImgPath(){
		return  $this->img_upd_path='upload/store';
	}
	//首页
	public function index(){
		$this->storeList();
	}
	//历史列表
	public function storeList(){
		$this->dataList("admin/storeList",$this->store_model, array(), array(),array(), $this->_data);
	}
	//添加关于我们 历史
	public function addStore(){
		$this->_data['list']=$this->store_type_model->getAllByWhere(array(),array('id','storescode'));
		$this->load->view('admin/addstore',$this->_data);
	}
	//获得分类
	public function getType($id){
	   $info=$this->store_type_model->getOneByWhere(array("id"=>$id),array('id','storescode'));
	   return $info->storescode;
	}
	//执行添加历史
	public function doAddstore(){
		$this->dataInsert($this->store_model);
	}
	//历史图片列表
	public function storePicList(){
		$this->dataList('admin/storePicList',$this->image_model,array("storesid"),array(),array('sort'=>'asc'),$this->_data);
	}
	//修改历史
	public  function updstore(){
		if(!trim($_GET['id'])) $this->error("非法调用");
		$info=$this->store_model->getOneBywhere(array("id"=>trim($_GET['id'])));
		if(!$info)   $this->error("非法调用");
		$this->_data['info']=$info;
		$this->_data['list']=$this->store_type_model->getAllByWhere(array(),array('id','storescode'));
		$this->load->view("admin/updstore",$this->_data);
	}
	//执行修改历史信息
	public function doUpdstore(){
		$this->dataUpdate($this->store_model);
	}
	//批量删除历史
	public function multDelstore(){
		$result = false;
		$idList = $this->input->post('id') ? $this->input->post('id') : '';
		$idList = explode(',',$idList);
		if (empty($idList)) {
			$this->output->append_output($result);
			return;
		}
		//删除历史记录
		foreach($idList as $val){
			$list=$this->image_model->getAllByWhere(array("storesid"=>$val));
			foreach ($list as $row) {
				$oldpath = $row->imagepath;
				$result = $this->dataDelete($this->image_model,array('id'=>$row->id),'id',false);
				//检查文件是否存在
				if (file_exists($oldpath)) {
					//删除物理文件
					@unlink($oldpath);
				}
			}
			$result = $this->dataDelete($this->store_model,array('id'=>$val),'id',false);
		}
		$this->output->append_output($result);
	}
	//单个删除历史
	public function singleDelstore(){
		$result = false;
		$id = $this->input->post('id') ? $this->input->post('id') : 0;
		if (!$id) {
			$this->output->append_output($result);
			return;
		}
		//读取原有数据，用来删除数据后，删除物理文件
		$list=$this->image_model->getAllByWhere(array("storesid"=>$id));
		foreach ($list as $row) {
			$oldpath = $row->imagepath;
			$result = $this->dataDelete($this->image_model,array('id'=>$row->id),'id',false);
			//检查文件是否存在
			if (file_exists($oldpath)) {
				//删除物理文件
				@unlink($oldpath);
			}
		}
		$result = $this->dataDelete($this->store_model,array('id'=>$id),'id',false);
		$this->output->append_output($result);
	}
    /**
	 * 上传图片
	 */
	public function upload_image() {
		echo $filepath = $this->upload_lib->upload_file($this->_getImgPath());
		//将图片文件信息写入数据库
		if ($filepath) {
			$info['storesid']=$_GET['storesid'];
			$info['imagepath'] = $filepath;
			$this->dataInsert($this->image_model,$info,false);
		}
	}
}
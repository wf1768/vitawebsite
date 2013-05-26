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
 * 新闻
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */
class press extends MY__Controller{


	// 传递到对应视图的变量
	private $_data;
	//构造函数
	function __construct() {
		parent::__construct();
		$this->_data['sys_title'] = '北京丰意德家具有限责任公司-关于我们';
		$this->load->model('press_model');
		$this->load->model('press_image_model','image_model');
		$this->_data['page_offset'] = 10;
		$this->_data['fun'] = 'press';
	}
	//设置图片上传路径
	public function _getImgPath(){
		return  $this->img_upd_path='upload/press';
	}
	//首页
	public function index(){
		$this->pressList();
	}
	//历史列表
	public function pressList(){
		$this->dataList("admin/pressList",$this->press_model, array(), array(),array(), $this->_data);
	}
	//添加关于我们 历史
	public function addPress(){
		$this->load->view('admin/addpress',$this->_data);
	}
	//执行添加历史
	public function doAddpress(){
		$this->dataInsert($this->press_model);
	}
	//历史图片列表
	public function pressPicList(){
		$this->dataList('admin/pressPicList',$this->image_model,array("pressid"),array(),array('sort'=>'asc'),$this->_data);
	}
	//修改历史
	public  function updpress(){
		if(!trim($_GET['id'])) $this->error("非法调用");
		$info=$this->press_model->getOneBywhere(array("id"=>trim($_GET['id'])));
		if(!$info)   $this->error("非法调用");
		$this->_data['info']=$info;
		$this->load->view("admin/updpress",$this->_data);
	}
	//执行修改历史信息
	public function doUpdpress(){
		$this->dataUpdate($this->press_model);
	}
	//批量删除历史
	public function multDelpress(){
		$result = false;
		$idList = $this->input->post('id') ? $this->input->post('id') : '';
		$idList = explode(',',$idList);
		if (empty($idList)) {
			$this->output->append_output($result);
			return;
		}
		//删除历史记录
		foreach($idList as $val){
			$list=$this->image_model->getAllByWhere(array("pressid"=>$val));
			foreach ($list as $row) {
				$oldpath = $row->imagepath;
				$result = $this->dataDelete($this->image_model,array('id'=>$row->id),'id',false);
				//检查文件是否存在
				if (file_exists($oldpath)) {
					//删除物理文件
					@unlink($oldpath);
				}
			}
			
		//刪除新聞封面
	      $index = $this->press_model->getOneByWhere(array("id"=>$val));
          $oldpath = $index->image;
          //检查文件是否存在
          if (file_exists($oldpath)) {
                //删除物理文件
                @unlink($oldpath);
          }
	      $result = $this->dataDelete($this->press_model,array('id'=>$val),'id',false);
		}
		$this->output->append_output($result);
	}
	//单个删除历史
	public function singleDelpress(){
		$result = false;
		$id = $this->input->post('id') ? $this->input->post('id') : 0;
		if (!$id) {
			$this->output->append_output($result);
			return;
		}
		//读取原有数据，用来删除数据后，删除物理文件
		$list=$this->image_model->getAllByWhere(array("pressid"=>$id));
		foreach ($list as $row) {
			$oldpath = $row->imagepath;
			$result =$this->dataDelete($this->image_model,array('id'=>$row->id),'id',false);
			//检查文件是否存在
			if (file_exists($oldpath)) {
				//删除物理文件
				@unlink($oldpath);
			}
		}
		//刪除新聞封面
	       $index = $this->press_model->getOneByWhere(array("id"=>trim($_POST['id'])));
          $oldpath = $index->image;
            //检查文件是否存在
            if (file_exists($oldpath)) {
                //删除物理文件
                @unlink($oldpath);
            }
		$result = $this->dataDelete($this->press_model,array('id'=>$id),'id',false);
		$this->output->append_output($result);
	}
	/**
	 * 上传图片
	 */
	public function upload_image() {
		$filepath = $this->upload_lib->upload_file($this->_getImgPath());
		//将图片文件信息写入数据库
		if ($filepath) {
			$info['pressid']=$_GET['pressid'];
			$info['imagepath'] = $filepath;
			$this->dataInsert($this->image_model,$info,false);
		}
	}
 public function upload_face_image() {
        if(!trim($_GET['id'])){
        	$this->error("错误调用");
        }
        $filepath = $this->upload_lib->upload_file('upload/press');
        //将图片文件信息写入数据库
        if ($filepath) {
            //读取原图，更新后，删除原图
            $index = $this->press_model->getOneByWhere(array("id"=>trim($_GET['id'])));
            $index_image['image'] = $filepath;
            $index_image['id']  =trim($_GET['id']);
            $oldpath = $index->image;
            $this->dataUpdate($this->press_model,$index_image,false);
            //检查文件是否存在
            if (file_exists($oldpath)) {
                //删除物理文件
                @unlink($oldpath);
            }
            $result = json_encode(array('newfilename'    => $filepath  ));
            $this->output->append_output($result);
        }
    }
}
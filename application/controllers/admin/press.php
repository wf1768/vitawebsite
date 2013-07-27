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
		$this->_data['sys_title'] = '北京丰意德家具有限责任公司-新闻';
		$this->load->model('press_model');
		$this->load->model('press_image_model','image_model');
		$this->load->model('press_video_model');
		$this->_data['page_offset'] = 10;
		$this->_data['fun'] = 'press';
	} 
	//修改排序
    public function edit_sort() {
		$result = false;
		$id = $this->input->post('id') ? $this->input->post('id') : '';
		$sort = $this->input->post('sort') ? $this->input->post('sort') : '';


		if (!$id) {
			$this->output->append_output($result);
			return;
		}
		$update_image['id'] = $id;
		$update_image['sort'] = $sort;
		$num = $this->dataUpdate($this->press_model,$update_image,false);
		if ($num > 0) {
			$result = true;
		}
		$this->output->append_output($result);
	}
	//设置图片上传路径
	public function _getImgPath(){
		return  $this->img_upd_path='upload/press';
	}
	//首页
	public function index(){
		$this->pressList();
	}
	//新闻列表
	public function pressList(){
		$this->dataList("admin/pressList",$this->press_model, array(), array(),array("sort"=>'asc'), $this->_data);
	}
	public function getmv($id){
	   return $this->press_video_model->getOneByWhere(array("pressid"=>trim($id)));
	}
	//添加关于我们 新闻
	public function addPress(){
		$this->load->view('admin/addpress',$this->_data);
	}
	//执行添加新闻
	public function doAddpress(){
		$this->dataInsert($this->press_model);
	}
	//新闻图片列表
	public function pressPicList(){
		$this->dataList('admin/pressPicList',$this->image_model,array("pressid"),array(),array('sort'=>'asc'),$this->_data);
	}
	//修改新闻
	public  function updpress(){
		if(!trim($_GET['id'])) $this->error("非法调用");
		$info=$this->press_model->getOneBywhere(array("id"=>trim($_GET['id'])));
		if(!$info)   $this->error("非法调用");
		$this->_data['info']=$info;
		$this->load->view("admin/updpress",$this->_data);
	}
	//执行修改新闻信息
	public function doUpdpress(){
		$this->dataUpdate($this->press_model);
	}
	//批量删除新闻
	public function multDelpress(){
		$result = false;
		$idList = $this->input->post('id') ? $this->input->post('id') : '';
		$idList = explode(',',$idList);
		if (empty($idList)) {
			$this->output->append_output($result);
			return;
		}
		//删除新闻记录
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
			//删除视频
		    $list=$this->press_video_model->getAllByWhere(array("pressid"=>$val));
			foreach ($list as $row) {
			    $mp4_video = $row->mp4path;
                $ogv_video = $row->flvpath;
                //检查文件是否存在
                if (file_exists($mp4_video)) {
                    //删除物理文件
                    @unlink($mp4_video);
                }
                if (file_exists($ogv_video)) {
                    //删除物理文件
                    @unlink($ogv_video);
                }
				
			}
			//删除视频
		    $this->dataDelete($this->press_video_model,array('pressid'=>$val),'pressid',false);
			$result = $this->dataDelete($this->press_model,array('id'=>$val),'id',false);
		}
		$this->output->append_output($result);
	}
	//单个删除新闻
	public function singleDelpress(){
		$result = false;
		$id = $this->input->post('id') ? $this->input->post('id') : 0;
		if (!$id) {
			$this->output->append_output($result);
			return;
		}
        //获取新闻对象
        $index = $this->press_model->getOneByWhere(array("id"=>trim($_POST['id'])));
        if ($index->type == 1) {
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
        }
        else if ($index->type == 2) {
            //删除视频新闻
            $press_video = $this->press_video_model->getOneByWhere(array("pressid"=>$id));
            if ($press_video) {
                $mp4_video = $press_video->mp4path;
                $ogv_video = $press_video->flvpath;
                //检查文件是否存在
                if (file_exists($mp4_video)) {
                    //删除物理文件
                    @unlink($mp4_video);
                }
                if (file_exists($ogv_video)) {
                    //删除物理文件
                    @unlink($ogv_video);
                }
            }
            $this->dataDelete($this->press_video_model,array('pressid'=>$id),'pressid',false);
        }
        else {
            $this->output->append_output($result);
            return;
        }

        //刪除新聞封面
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
	public function upload_film(){
		if(!trim($_GET['id'])){
			$this->error("错误调用");
		}
		$oldpath='';
		$filepath = $this->upload_lib->upload_file('upload/press');


		$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
		$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
		$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';
		// Check if file has been uploaded
		if (!$chunks || $chunk == $chunks - 1) {
			//将图片文件信息写入数据库
			if ($filepath) {
				//读取原图，更新后，删除原图
				$indexs = $this->press_video_model->getOneByWhere(array("pressid"=>trim($_GET['id'])));
				$ext=strtolower($this->getExtend($filepath));
				if($ext=="mp4"){ //MP4 格式
					$index_file['mp4path'] = $filepath;
					if($indexs) $oldpath = $indexs->mp4path;
				}else{
					$index_file['flvpath'] = $filepath;
					if($indexs) $oldpath = $indexs->flvpath;
				}
				$index_file['pressid']=trim($_GET['id']);
                if($indexs){
                	$index_file['id']=$indexs->id;
                	$this->dataUpdate($this->press_video_model,$index_file,false);
                }else{
                	$this->dataInsert($this->press_video_model,$index_file,false);
                }
				   
				
				
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
	public function getExtend($file_name){
		$extend =explode("." , $file_name);
		$va=count($extend)-1;
		return $extend[$va];
	}
}
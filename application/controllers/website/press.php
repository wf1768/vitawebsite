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
 * main MY_Controller Class
 *
 * website 新闻页。
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class press extends CI_Controller {

	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 */
	function __construct() {
		parent::__construct();
        $this->load->model('press_model');
        $this->load->model('press_image_model');
        $this->load->model('press_video_model');
        
        $this->_data['sys_title'] = '北京丰意德家具有限责任公司';
	}
	/**
	 * 转到新闻页
	 */
	public function index() {
        //获取品牌logo列表,加入到_data中
        $data = $this->website_lib->product_info();
        $this->_data = array_merge($this->_data,$data);
        
        //获取新闻列表。
        $pressid = $this->input->get('pressid') ? $this->input->get('pressid') : '';
        
		$press_list = $this->press_list();
    	$this->_data['pressList'] = $press_list;
    	//初始加载一条
    	$press_obj = $this->getOnePress($pressid);
    	$this->_data['pressObj'] = $press_obj;

    	$pressImgList = $this->getPressImg($press_obj->id);
    	$this->_data['press_ImgList'] = $pressImgList;
    	
        $this->load->view('website/press',$this->_data);
	}

	/**
     * 获取新闻
     * @param string $press_id
     * @return mixed
     */
    public function press_list() {
    	//获取全部新闻
        $press_list = $this->press_model->getAllByWhere();
        return $press_list;
    }
    
    /**
     * 得到一条新闻
     * @param $press_id
     * @return $press_obj
     */
    public function getOnePress($press_id = ''){
    	//如果传入新闻id，获取该ID新闻信息
    	if($press_id){
    		$press_obj = $this->press_model->getOne($press_id);
    		return $press_obj; 
    	}else{
    		$press_obj = $this->press_model->getOneByWhere();
    		return $press_obj; 
    	}
    }
    
    /**
     * 得到一条新闻的所有图片
     * @param $pressid
     * @return $pressImgList
     */
    public function getPressImg($pressid){
    	$pressImgList = false;
    	if($pressid){
    		$pressImgList = $this->press_image_model->getAllByWhere(array('pressid'=>$pressid),array(),array('sort'=>'desc'));
    	}
    	return $pressImgList;
    }
	/**
     * 得到一条新闻的视频
     * @param $pressid
     * @return $press_video
     */
    public function getPressVideo($pressid){
    	$press_video = false;
    	if($pressid){
    		$press_video = $this->press_video_model->getOneByWhere(array('pressid'=>$pressid),array(),array());
    	}
    	return $press_video;
    }
    
    public function press_get(){
    	//获取品牌logo列表,加入到_data中
        $data = $this->website_lib->product_info();
        $this->_data = array_merge($this->_data,$data);
        
        //获取新闻列表。
        $pressid = $this->input->get('pressid') ? $this->input->get('pressid') : '';
        
		$press_list = $this->press_list();
    	$this->_data['pressList'] = $press_list;
    	
    	//初始加载一条
    	$press_obj = $this->getOnePress($pressid);
    	$this->_data['pressObj'] = $press_obj;
    	$type = $press_obj->type;
    	if($type==1){
			//新闻大图片
	    	$pressImgList = $this->getPressImg($press_obj->id);
	    	$this->_data['press_ImgList'] = $pressImgList;
    	}else{
	    	//新闻视频
	    	$press_video = $this->getPressVideo($press_obj->id);
	    	$this->_data['pressVideo'] = $press_video;
    	}
    	//默认加载的新闻ID
    	$this->_data['df_pressid'] = $press_obj->id;
    	$this->_data['type'] = $type;
    	
        $this->load->view('website/press',$this->_data);
    }
}

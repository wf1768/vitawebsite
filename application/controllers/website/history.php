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
 * website 关于我们。
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class history extends CI_Controller {

	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('history_model',"model");
		$this->load->model('history_image_model','img_model');
		$this->_data['sys_title'] = '北京丰意德家具有限责任公司';
	}
	/**
	 * 转到引导页
	 */
	public function index() {
		 //获取配置，首页采用图片或者视频模式
        $this->_data['open']= $this->website_lib->config('about_marking');
		//获取品牌logo列表,加入到_data中
		$data = $this->website_lib->product_info();
		$this->_data = array_merge($this->_data,$data);
		//获取首页轮播图片列表。
		$this->_data['history']=$this->model->getAllByWhere(array(),array(),array('year'=>'asc'));
		if(isset($_GET['id'])){
			 $indeximg=$this->img_model->getAllByWhere(array("historyid"=>trim($_GET['id'])));
			 $this->_data['showinfo']=$this->model->getOneByWhere(array("id"=>trim($_GET['id'])));
			 $this->_data['indeximg']=json_encode($indeximg);
		}else{
			//取出历史的图片
			foreach($this->_data['history'] as $key=>$val){
				$info=$this->img_model->getAllByWhere(array("historyid"=>$val->id));
				if($info) $this->_data['imgs'][$val->year]=$info;
			}
			$indeximg=array_slice($this->_data['imgs'],0,1);
			$this->_data['showinfo']=$this->_data['history'][0];
			$this->_data['indeximg']=json_encode($indeximg[0]);
		}
        
		//        print_r();
		//$this->_data['showinfo']=$this->model->getOneByWhere(array("id"=>trim($_GET['id'])));
		$this->load->view('website/history',$this->_data);
	}

}

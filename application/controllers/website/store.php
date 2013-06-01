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

class store extends CI_Controller {

	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('store_model',"model");
		$this->load->model('store_image_model','img_model');
		$this->load->model('store_type_model');
		$this->_data['sys_title'] = '北京丰意德家具有限责任公司';
	}
	/**
	 * 转到引导页
	 */
	public function index() {
		//获取品牌logo列表,加入到_data中
		$data = $this->website_lib->product_info();
		$this->_data = array_merge($this->_data,$data);


		if(isset($_GET['typeid'])){
			$typeid=trim($_GET['typeid']);
			$this->_data['storelist']=$this->model->getAllByWhere(array("typeid"=>$typeid));
		}else{
		    $tmpinfo=$this->store_type_model->getOneByWhere();
		    $this->_data['storelist']=$this->model->getAllByWhere();
		    $typeid=trim($tmpinfo->storescode);
		}



		//获取首页轮播图片列表。
		
		if(isset($_GET['id'])){
			$indeximg=$this->img_model->getAllByWhere(array("storesid"=>trim($_GET['id'])));
			$this->_data['showinfo']=$this->model->getOneByWhere(array("id"=>trim($_GET['id'])));
			$this->_data['indeximg']=json_encode($indeximg);
		}else{
			//取出历史的图片
			foreach($this->_data['storelist'] as $key=>$val){
				$info=$this->img_model->getAllByWhere(array("storesid"=>$val->id));
				if($info) $this->_data['imgs'][]=$info;
			}
			$indeximg=array_slice($this->_data['imgs'],0,1);
			$this->_data['showinfo']=$this->_data['storelist'][0];
			$this->_data['indeximg']=json_encode($indeximg[0]);
		}
		$this->_data['typeid']=$typeid;
		$this->_data['class']=$this->store_type_model->getAllByWhere();
		$this->load->view('website/store',$this->_data);
	}

}

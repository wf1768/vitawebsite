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
 * website 首页。
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class product extends CI_Controller {

	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 */
	function __construct() {
		parent::__construct();
        $this->load->model('product_cate_model');
        $this->load->model('product_image_model');
        $this->_data['sys_title'] = '北京丰意德家具有限责任公司';
	}
	/**
	 * 转到引导页
	 */
	public function index() {
//        //获取品牌logo列表,加入到_data中
//        $data = $this->website_lib->product_info();
//        $this->_data = array_merge($this->_data,$data);
//        //获取首页轮播图片列表。
//        $main = $this->main_model->getAllByWhere(array(),array(),array('sort'=>'asc'));
//        $this->_data['main'] = $main;
//        $this->load->view('website/main',$this->_data);
	}

    /**
     * 获取商品系列或品牌全部系列
     * @param string $product_cate_id
     * @param string $product_brand_id
     * @return mixed
     */
    public function product_cate($product_cate_id = '',$product_brand_id = '') {
        //如果传入品牌id，获取单个品牌信息
        if ($product_cate_id) {
            $product_cate = $this->product_cate_model->getOne($product_cate_id);
            return $product_cate;
        }
        else {
            //获取全部信息
            $product_cate = $this->product_cate_model->getAllByWhere(array('brandid'=>$product_brand_id),array(),array('sort'=>'asc'));
            return $product_cate;
        }
    }

    /**
     * 根据whoid获取图片列表
     * @param $whoid
     * @return bool
     */
    public function product_image($whoid) {
        $product_image = false;
        if ($whoid) {
            $product_image = $this->product_image_model->getAllByWhere(array('whoid'=>$whoid),array(),array('sort'=>'asc'));
        }
        return $product_image;
    }

    /**
     * 根据品牌id，打开商品展示页
     */
    public function product_get() {
        $brandid = $this->input->get('brandid') ? $this->input->get('brandid') : '';
        $cateid = $this->input->get('cateid') ? $this->input->get('cateid') : '';
        $type = $this->input->get('type') ? $this->input->get('type') : '';

        //获取品牌信息
        $product_brand = $this->website_lib->product_brand($brandid);
        $this->_data['product_brand'] = $product_brand;
        if ($type == 'cate') {
            $product_cate = $this->product_cate($cateid);
            $this->_data['product_cate'] = $product_cate;
        }

        //获取所有品牌信息
        $data = $this->website_lib->product_info();
        $this->_data = array_merge($this->_data,$data);
        $this->_data['type'] = $type;

        $product_cate = false;
        if ($type == 'brand') {
            //获取当前附属的图片
            $product_image = $this->product_image($brandid);
            $this->_data['product_image'] = $product_image;
//            $this->_data['type'] = 'brand';
        }

        else if ($type == 'cate') {
            //获取当前附属的图片
            $product_image = $this->product_image($cateid);
            $this->_data['product_image'] = $product_image;
            //获取当前cate
            $product_cate = $this->product_cate_model->getOne($cateid);
        }

        $this->_data['product_cate'] = $product_cate;

        //获取当前品牌下系列
        $product_cates = $this->product_cate('',$brandid);
        $this->_data['product_cates'] = $product_cates;


        $this->load->view('website/product',$this->_data);

//        //获取品牌信息
//        $product_brand = $this->product_brand($id);
//        $this->_data['product_brand'] = $product_brand;
//        //获取所有品牌信息
//        $this->product_info();
//
//        //获取当前品牌附属的图片
//        $product_image = $this->product_image($id);
//        $this->_data['product_image'] = $product_image;
//        //获取当前品牌下系列
//        $product_cate = $this->product_cate('',$id);
//        $this->_data['product_cate'] = $product_cate;
//
//        $this->load->view('website/product',$this->_data);
    }

}

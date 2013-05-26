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
 * 前台获取数据统一控制器。
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class site extends CI_Controller {

	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 */
	function __construct() {
		parent::__construct();
        $this->load->model('index_model');
        $this->load->model('main_model');

        $this->load->model('config_model');
        $this->load->model('product_brand_model');
        $this->load->model('product_cate_model');
        $this->load->model('product_image_model');

        $this->load->model('history_model');
        $this->load->model('history_image_model');

        $this->_data['sys_title'] = '北京丰意德家具有限责任公司';

	}
	/**
	 *
	 */
	public function index() {

	}

    /**
     * 打开引导页
     */
    public function home() {
        $index = $this->index_model->getOne('1');
        if ($index) {
            $this->_data['index'] = $index;
            $this->load->view('website/index',$this->_data);
        }
        else {
            //如果没有找到怎么处理？
        }
    }

    /**
     * 获取系统配置
     */
    public function config($key) {
        $config = $this->config_model->getOneByWhere(array('key'=>$key));
        return $config;
    }

    /**
     * 获取商品品牌
     */
    public function product_brand($product_brand_id = '',$product_type_id = '') {
        //如果传入品牌id，获取单个品牌信息
        if ($product_brand_id) {
            $product_brand = $this->product_brand_model->getOne($product_brand_id);
            return $product_brand;
        }
        else {
            //获取全部品牌信息
            $product_brand = $this->product_brand_model->getAllByWhere(array('typeid'=>$product_type_id),array(),array('sort'=>'asc'));
            return $product_brand;
        }
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

    public function product_info() {
        //获取家具一级品牌菜单
        $product_brand_furniture = $this->product_brand('','1');
        $this->_data['product_brand_furniture'] = $product_brand_furniture;

        //获取配置，是否有饰品的一级菜单开启
        $config = $this->config('type_housewares');
        //如果开启了饰品一级菜单,获取饰品一级品牌列表
        $product_brand_housewares = false;
        if ($config->value == '1') {
            $product_brand_housewares = $this->product_brand('','2');
        }
        $this->_data['product_brand_housewares'] = $product_brand_housewares;
    }

    /**
     * 打开主页
     */
    public function main() {
        $this->product_info();
        $main = $this->main_model->getAllByWhere(array(),array(),array('sort'=>'asc'));
        $this->_data['main'] = $main;
        $this->load->view('website/main',$this->_data);
    }


    /**
     * 根据品牌id，打开商品展示页
     */
    public function product() {
        $brandid = $this->input->get('brandid') ? $this->input->get('brandid') : '';
        $cateid = $this->input->get('cateid') ? $this->input->get('cateid') : '';
        $type = $this->input->get('type') ? $this->input->get('type') : '';

        //获取品牌信息
        $product_brand = $this->product_brand($brandid);
        $this->_data['product_brand'] = $product_brand;
        if ($type == 'cate') {
            $product_cate = $this->product_cate($cateid);
            $this->_data['product_cate'] = $product_cate;
        }

        //获取所有品牌信息
        $this->product_info();

        if ($type == 'brand') {
            //获取当前附属的图片
            $product_image = $this->product_image($brandid);
            $this->_data['product_image'] = $product_image;

        }
        else if ($type == 'cate') {
            //获取当前附属的图片
            $product_image = $this->product_image($cateid);
            $this->_data['product_image'] = $product_image;
        }

        //获取当前品牌下系列
        $product_cate = $this->product_cate('',$brandid);
        $this->_data['product_cate'] = $product_cate;


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

    /**
     * 打开关于我们
     */
    public function about() {
        //年份id，如果没有传入，就默认排序第一的年份
        $id = $this->input->get('id') ? $this->input->get('id') : '';
        //获取品牌菜单
        $this->product_info();
        //获取配置，是否开启了照片墙
        $config = $this->config('about_marking');
        $marking = false;
        if ($config->value == '1') {
            $marking = true;
        }
        //根据这个，点击about时，就不显示照片墙按钮
        $this->_data['marking'] = $marking;
        //获取全部历史年份信息。用来生成年份列表
        $history = $this->history_model->getAllByWhere(array(),array(),array('sort'=>'asc'));

        $this->_data['history'] = $history;
        //获取历史图片
        if ($id) {
            $history_action = $this->history_model->getOne($id);
            //获取年份图片
            $history_image = $this->history_image_model->getAllByWhere(array('historyid'=>$id),array(),array('sort'=>'asc'));
            $this->_data['history_image'] = $history_image;
        }
        else {
            $history_action = $history[0];
            $history_image = $this->history_image_model->getAllByWhere(array('historyid'=>$history_action->id),array(),array('sort'=>'asc'));
        }
        $this->_data['history_action'] = $history_action;
        $this->_data['history_image'] = $history_image;

        $this->load->view('website/history',$this->_data);

    }

}

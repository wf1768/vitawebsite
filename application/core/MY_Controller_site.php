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
 * 前台读取数据核心类。
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */


class MY_Controller extends CI_Controller{

	function __construct() {

		parent::__construct();

		//设定日期格式
		date_default_timezone_set('PRC');

        $this->load->model('index_model');
        $this->load->model('main_model');
        $this->load->model('config_model');
        $this->load->model('product_brand_model');
        $this->load->model('product_cate_model');
        $this->load->model('product_image_model');
        $this->load->model('history_model');
        $this->load->model('history_image_model');


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

}

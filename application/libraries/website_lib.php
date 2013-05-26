<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * stock System
 *
 * 基于ci的商品管理系统
 *
 * @package
 * @author		blues <blues0118@gmail.com>
 * @copyright	Copyright (c) 2013 - 2015, ussoft.net.
 * @license
 * @link
 * @version		0.1.0
 */

// ------------------------------------------------------------------------

/**
 * website Library Class
 *
 * 前台读取数据。主要是各模块都读取的品牌logo列表。做成公共的
 *
 * @package		website
 * @subpackage	Libraries
 * @category	Libraries
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class website_lib {

    /**
     * CI句柄
     *
     * @access private
     * @var object
     */
    private $_CI;

    /**
     * 构造函数
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        /** 获取CI句柄 */
        $this->_CI = & get_instance();
        $this->_CI->load->model('config_model');
        $this->_CI->load->model('product_brand_model');

        log_message('debug', "website library Class Initialized");
    }

    /**
     * 获取系统配置
     */
    public function config($key) {
        $config = $this->_CI->config_model->getOneByWhere(array('key'=>$key));
        return $config;
    }

    /**
     * 获取商品品牌
     */
    public function product_brand($product_brand_id = '',$product_type_id = '') {
        //如果传入品牌id，获取单个品牌信息
        if ($product_brand_id) {
            $product_brand = $this->_CI->product_brand_model->getOne($product_brand_id);
            return $product_brand;
        }
        else {
            //获取全部品牌信息
            $product_brand = $this->_CI->product_brand_model->getAllByWhere(array('typeid'=>$product_type_id,'status'=>1),array(),array('sort'=>'asc'));
            return $product_brand;
        }
    }


    /**
     * 每个模块页面都需要得到页面顶部的品牌logo菜单。
     * 调用本方法，返回数组，页面控制器中加入到this->_data中
     * @return array
     */
    public function product_info() {
        $data = array();
        //获取家具一级品牌菜单
        $product_brand_furniture = $this->product_brand('','1');
        $data['product_brand_furniture'] = $product_brand_furniture;

        //获取配置，是否有饰品的一级菜单开启
        $config = $this->config('type_housewares');
        //如果开启了饰品一级菜单,获取饰品一级品牌列表
        $product_brand_housewares = false;
        if ($config->value == '1') {
            $product_brand_housewares = $this->product_brand('','2');
        }
        $data['product_brand_housewares'] = $product_brand_housewares;

        return $data;
    }


}

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
 * 商品图片 控制器
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class product_image extends MY__Controller {

	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 */
	function __construct() {
		parent::__construct();
        $this->_data['sys_title'] = '北京丰意德家具有限责任公司--商品品牌图片管理';
        $this->load->model('product_cate_model');
        $this->load->model('product_brand_model');
//        $this->load->model('product_type_model');
        $this->load->model('product_image_model','image_model');
        $this->_data['fun'] = 'product';

        $this->_data['page_offset'] = 10;
	}


	/**
	 *
	 */
	public function index() {
        $who = $this->input->get('who') ? $this->input->get('who') : '';
        $whoid = $this->input->get('whoid') ? $this->input->get('whoid') : '';
        $typeid = $this->input->get('typeid') ? $this->input->get('typeid') : '';

        $product_image = $this->image_model->getOne($whoid);

        //获取是谁的图片
        if ($who == 'brand') {
            $brand = $this->product_brand_model->getOne($whoid);
            $this->_data['code'] = $brand->brandcode;
            $this->_data['typeid'] = $typeid;
        }
        else if ($who == 'cate') {
            $cate = $this->product_cate_model->getOne($whoid);
            $this->_data['code'] = $cate->catecode;
            $this->_data['brandid'] = $cate->brandid;
            $this->_data['typeid'] = $typeid;
        }
        else {
            $this->_data['code'] = '未知';
        }

        $this->_data['who'] = $who;

        $this->_data['whoid'] = $whoid;
        $this->_data['product_image'] = $product_image;

        $this->dataList('admin/product_image',$this->image_model,array('whoid'),array(),array('sort'=>'asc'),$this->_data);
	}

    public function edit_image() {
        $result = false;
        $id = $this->input->post('id') ? $this->input->post('id') : '';
        $sort = $this->input->post('sort') ? $this->input->post('sort') : '';
        $content = $this->input->post('content') ? $this->input->post('content') : '';


        if (!$id) {
            $this->output->append_output($result);
            return;
        }
        $update_image['id'] = $id;
        $update_image['sort'] = $sort;
        $update_image['content'] = $content;
        $num = $this->dataUpdate($this->image_model,$update_image,false);
        if ($num > 0) {
            $result = true;
        }
        $this->output->append_output($result);
    }

    /**
     * 上传图片
     */
    public function upload_image() {

        $filepath = $this->upload_lib->upload_file('upload/product/product_image');
        $who = $this->input->get('who') ? $this->input->get('who') : '';
        $whoid = $this->input->get('whoid') ? $this->input->get('whoid') : '';

        //将图片文件信息写入数据库
        if ($filepath) {
            $product_image['imagepath'] = $filepath;
            $product_image['who'] = $who;
            $product_image['whoid'] = $whoid;
            $this->dataInsert($this->image_model,$product_image,false);
        }
    }

}

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
 * 商品系列 控制器
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class product_cate extends MY__Controller {

	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 */
	function __construct() {
		parent::__construct();
        $this->_data['sys_title'] = '北京丰意德家具有限责任公司--商品系列管理';
        $this->load->model('product_cate_model');
        $this->load->model('product_brand_model');
        $this->load->model('product_type_model');
        $this->load->model('product_image_model');
        $this->_data['fun'] = 'product';

        $this->_data['page_offset'] = 10;
	}


	/**
	 * 转到登录页面
	 */
	public function index() {
        $typeid = $this->input->get('typeid') ? $this->input->get('typeid') : '';
        $brandid = $this->input->get('brandid') ? $this->input->get('brandid') : '';
        //获取商品分类
        $product_type = $this->product_type_model->getOne($typeid);
        $product_brand = $this->product_brand_model->getOne($brandid);


        $this->_data['typecode'] = $product_type->typecode;
        $this->_data['typeid'] = $product_type->id;
        $this->_data['brandcode'] = $product_brand->brandcode;
        $this->_data['brandid'] = $product_brand->id;

        $this->dataList('admin/product_cate',$this->product_cate_model,array('brandid'),array(),array('sort'=>'asc'),$this->_data);
	}

    public function add() {
        $result = false;

        $brandid = $this->input->post('brandid') ? $this->input->post('brandid') : '';
        $catecode = $this->input->post('catecode') ? $this->input->post('catecode') : '';
        $catecodecn = $this->input->post('catecodecn') ? $this->input->post('catecodecn') : '';

        $insert_data['brandid'] = $brandid;
        $insert_data['catecode'] = $catecode;
        $insert_data['catecodecn'] = $catecodecn;
        $insert_data['status'] = 0;
        $insert_data['sort'] = 1;

        $id = $this->dataInsert($this->product_cate_model,$insert_data,false);
        if ($id) {
            $result = true;
        }
        $this->output->append_output($result);
    }

    public function remove() {
        $result = false;

        $id = $this->input->post('id') ? $this->input->post('id') : '';
        try {
            //删除品牌下附属商品图片
            $product_image = $this->product_image_model->getAllByWhere(array('whoid'=>$id));

            if ($product_image) {
                foreach ($product_image as $image) {
                    if ($image->imagepath) {
                        //检查文件是否存在
                        if (file_exists($image->imagepath)) {
                            //删除物理文件
                            @unlink($image->imagepath);
                        }
                    }
                    $tmp['id'] = $image->id;
                    $this->dataDelete($this->product_image_model,'id',$tmp,false);
                }
            }

            $product_cate = $this->product_cate_model->getOne($id);

            if ($product_cate) {
                    if ($product_cate->imagepath) {
                        //检查文件是否存在
                        if (file_exists($product_cate->imagepath)) {
                            //删除物理文件
                            @unlink($product_cate->imagepath);
                        }
                    }
                    if ($product_cate->imagepathchange) {
                        //检查文件是否存在
                        if (file_exists($product_cate->imagepathchange)) {
                            //删除物理文件
                            @unlink($product_cate->imagepathchange);
                        }
                    }
                    if ($product_cate->imagepathcn) {
                        if (file_exists($product_cate->imagepathcn)) {
                            //删除物理文件
                            @unlink($product_cate->imagepathcn);
                        }
                    }
                    if ($product_cate->imagepathchangecn) {
                        if (file_exists($product_cate->imagepathchangecn)) {
                            //删除物理文件
                            @unlink($product_cate->imagepathchangecn);
                        }
                    }


                    $tmp['id'] = $product_cate->id;
                    $num = $this->dataDelete($this->product_cate_model,$tmp,'id',false);
                    if ($num > 0 ) {
                        $result = true;
                    }
                    $this->output->append_output($result);
            }
        } catch (Exception $e) {
            $this->output->append_output($result);
            return;
        }
    }

    public function edit() {
        $id = $this->input->get('id') ? $this->input->get('id') : '';
        $typeid = $this->input->get('typeid') ? $this->input->get('typeid') : '';
        $brandid = $this->input->get('brandid') ? $this->input->get('brandid') : '';
        $cate = $this->product_cate_model->getOne($id);

        $this->_data['id'] = $id;
        $this->_data['cate'] = $cate;
        $this->_data['typeid'] = $typeid;
        $this->_data['brandid'] = $brandid;

        if (!$cate) {
            $this->error('没有得到要修改的系列，请刷新，重新操作或与管理员联系。',site_url('a/product_cate?brandid=').$brandid.'&typeid='.$typeid);
        }

        $this->dataEdit('admin/product_cate_edit',$this->product_cate_model,$this->_data);
    }

    public function save() {
        $id = $this->input->post('cateid') ? $this->input->post('cateid') : '';
        $typeid = $this->input->post('typeid') ? $this->input->post('typeid') : '';
        $brandid = $this->input->post('brandid') ? $this->input->post('brandid') : '';
        $catecode = $this->input->post('catecode') ? $this->input->post('catecode') : '';
        $catecodecn = $this->input->post('catecodecn') ? $this->input->post('catecodecn') : '';
        $title = $this->input->post('title') ? $this->input->post('title') : '';
//        $content = $this->input->post('content') ? $this->input->post('content') : '';
        $sort = $this->input->post('sort') ? $this->input->post('sort') : '';
        $status= $this->input->post('status') ? $this->input->post('status') : '';


        //
        $product_cate['id'] = $id;
        $product_cate['catecode'] = $catecode;
        $product_cate['catecodecn'] = $catecodecn;
        $product_cate['title'] = $title;
//        $product_brand['content'] = $content;
        $product_cate['sort'] = $sort;
        $product_cate['status'] = $status;

        $num = $this->dataUpdate($this->product_cate_model,$product_cate,false);

        if ($num >= 0) {
            $this->success('保存成功。',site_url('a/product_cate?brandid='.$brandid.'&typeid=').$typeid);
        }
        else {
            $this->error('保存失败，请重新尝试或与管理员联系。',site_url('a/product_cate?brandid='.$brandid.'&typeid=').$typeid);
        }
    }

}

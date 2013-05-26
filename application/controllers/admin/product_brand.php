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
 * 后台 产品品牌 控制器
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class product_brand extends MY__Controller {

	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 */
	function __construct() {
		parent::__construct();
        $this->_data['sys_title'] = '北京丰意德家具有限责任公司--品牌管理';
        $this->load->model('product_brand_model');
        $this->load->model('product_type_model');
        $this->load->model('product_image_model');
        $this->load->model('product_cate_model');
        $this->_data['fun'] = 'product';

        $this->_data['page_offset'] = 10;
	}


	/**
	 * 转到登录页面
	 */
	public function index() {
        $typeid = $this->input->get('typeid') ? $this->input->get('typeid') : '';
        //获取商品分类
        $product_type = $this->product_type_model->getOne($typeid);

        $this->_data['typecode'] = $product_type->typecode;
        $this->_data['typeid'] = $product_type->id;

        $this->dataList('admin/product_brand',$this->product_brand_model,array('typeid'),array(),array('sort'=>'asc'),$this->_data);
	}

    public function add() {
        $result = false;

        $typeid = $this->input->post('typeid') ? $this->input->post('typeid') : '';
        $brandcode = $this->input->post('brandcode') ? $this->input->post('brandcode') : '';

        $insert_data['typeid'] = $typeid;
        $insert_data['brandcode'] = $brandcode;
        $insert_data['status'] = 0;
        $insert_data['sort'] = 1;

        $id = $this->dataInsert($this->product_brand_model,$insert_data,false);
        if ($id) {
            $result = true;
        }
        $this->output->append_output($result);
    }


    public function edit() {
        $id = $this->input->get('id') ? $this->input->get('id') : '';
        $typeid = $this->input->get('typeid') ? $this->input->get('typeid') : '';
        $brand = $this->product_brand_model->getOne($id);

        $this->_data['id'] = $id;
        $this->_data['brand'] = $brand;
        $this->_data['typeid'] = $typeid;

        if (!$brand) {
            $this->error('没有得到要修改的品牌，请刷新，重新操作或与管理员联系。',site_url('a/product_brand'));
        }

        $this->dataEdit('admin/product_brand_edit',$this->product_brand_model,$this->_data);
    }

    public function save() {
        $id = $this->input->post('brandid') ? $this->input->post('brandid') : '';
        $typeid = $this->input->post('typeid') ? $this->input->post('typeid') : '';
        $brandcode = $this->input->post('brandcode') ? $this->input->post('brandcode') : '';
        $title = $this->input->post('title') ? $this->input->post('title') : '';
        $content = $this->input->post('content') ? $this->input->post('content') : '';
        $sort = $this->input->post('sort') ? $this->input->post('sort') : '';
        $url = $this->input->post('url') ? $this->input->post('url') : '';
        $status= $this->input->post('status') ? $this->input->post('status') : '';


        //
        $product_brand['id'] = $id;
        $product_brand['brandcode'] = $brandcode;
        $product_brand['title'] = $title;
        $product_brand['content'] = $content;
        $product_brand['sort'] = $sort;
        $product_brand['url'] = $url;
        $product_brand['status'] = $status;

        $num = $this->dataUpdate($this->product_brand_model,$product_brand,false);

        if ($num >= 0) {
            $this->success('保存成功。',site_url('a/product_brand?typeid=').$typeid);
        }
        else {
            $this->error('保存失败，请重新尝试或与管理员联系。',site_url('a/product_brand?typeid=').$typeid);
        }
    }

    public function remove() {
        $result = false;

        $id = $this->input->post('id') ? $this->input->post('id') : '';
//        $typeid = $this->input->get('typeid') ? $this->input->get('typeid') : '';


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

            //删除品牌下附属的商品系列（包括系列下包含的图片）
            $product_cate = $this->product_cate_model->getAllByWhere(array('brandid'=>$id));

            if ($product_cate) {
                foreach ($product_cate as $cate) {
                    if ($cate->imagepath) {
                        //检查文件是否存在
                        if (file_exists($cate->imagepath)) {
                            //删除物理文件
                            @unlink($cate->imagepath);
                        }
                    }
                    if ($cate->imagepathchange) {
                        //检查文件是否存在
                        if (file_exists($cate->imagepathchange)) {
                            //删除物理文件
                            @unlink($cate->imagepathchange);
                        }
                    }
                    if ($cate->imagepathcn) {
                        if (file_exists($cate->imagepathcn)) {
                            //删除物理文件
                            @unlink($cate->imagepathcn);
                        }
                    }
                    if ($cate->imagepathchangecn) {
                        if (file_exists($cate->imagepathchangecn)) {
                            //删除物理文件
                            @unlink($cate->imagepathchangecn);
                        }
                    }

                    //获取商品系列包含的轮播图片
                    //删除品牌下附属商品图片
                    $product_cate_image = $this->product_image_model->getAllByWhere(array('whoid'=>$cate->id));

                    if ($product_cate_image) {
                        foreach ($product_cate_image as $cate_image) {
                            if ($cate_image->imagepath) {
                                //检查文件是否存在
                                if (file_exists($cate_image->imagepath)) {
                                    //删除物理文件
                                    @unlink($cate_image->imagepath);
                                }
                            }
                            $tmp['id'] = $cate_image->id;
                            $this->dataDelete($this->product_image_model,'id',$tmp,false);
                        }
                    }

                    $tmp['id'] = $cate->id;
                    $this->dataDelete($this->product_cate_model,'id',$tmp,false);
                }
            }
        } catch (Exception $e) {
            $this->output->append_output($result);
            return;
//            print $e->getMessage();
        }

        $brand = $this->product_brand_model->getOne($id);
        //删除本身图片
        //检查文件是否存在
        if (file_exists($brand->imagepath)) {
            //删除物理文件
            @unlink($brand->imagepath);
        }

        if (file_exists($brand->imagepathchange)) {
            //删除物理文件
            @unlink($brand->imagepathchange);
        }

        $remove['id'] = $id;

        $num = $this->dataDelete($this->product_brand_model,$remove,'id',false);

        if ($num > 0 ) {
            $result = true;
        }
        $this->output->append_output($result);
    }

    /**
     * 上传图片
     */
    public function upload_single_image() {

        $id = $this->input->get('id') ? $this->input->get('id') : '';
        $type = $this->input->get('type') ? $this->input->get('type') : '';
        $filepath = $this->upload_lib->upload_file('upload/product/product_brand');

        //将图片文件信息写入数据库
        if ($filepath) {
            //读取原图，更新后，删除原图
            $product_brand = $this->product_brand_model->getOne($id);
            $oldpath = '';
            $product_brand_image['id'] = $product_brand->id;
            $product_brand_image[$type] = $filepath;
            $oldpath = $product_brand->$type;

            $this->dataUpdate($this->product_brand_model,$product_brand_image,false);

            //检查文件是否存在
            if (file_exists($oldpath)) {
                //删除物理文件
                @unlink($oldpath);
            }

            $result = json_encode(array(
                'newfilename'    => $filepath
            ));

            $this->output->append_output($result);
        }
    }
}

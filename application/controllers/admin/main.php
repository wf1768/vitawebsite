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
 * 后台 main页
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class main extends MY__Controller {

	/**
	 * 传递到对应视图的变量
	 */
	private $_data;

	/**
	 * 构造函数
	 */
	function __construct() {
		parent::__construct();
        $this->_data['sys_title'] = '北京丰意德家具有限责任公司--首页管理';
        $this->load->model('main_model');
        $this->_data['fun'] = 'main';

        $this->_data['page_offset'] = 10;
	}


	/**
	 * 转到登录页面
	 */
	public function index() {
        $this->dataList('admin/main',$this->main_model,array(),array(),array('sort'=>'asc'),$this->_data);
	}

    /**
     * 上传图片
     */
    public function upload_image() {

        $filepath = $this->upload_lib->upload_file('upload/main');

        //将图片文件信息写入数据库
        if ($filepath) {
            $main_image['imagepath'] = $filepath;
            $this->dataInsert($this->main_model,$main_image,false);
        }
    }

    public function single_remove_image() {
        $result = false;

        $id = $this->input->post('id') ? $this->input->post('id') : 0;
        if (!$id) {
            $this->output->append_output($result);
            return;
        }
        //读取原有数据，用来删除数据后，删除物理文件
        $row = $this->main_model->getOne($id);
        $oldpath = $row->imagepath;

        $result = $this->dataDelete($this->main_model,array('id'=>$id),'id',false);

        //检查文件是否存在
        if (file_exists($oldpath)) {
            //删除物理文件
            @unlink($oldpath);
        }

        $this->output->append_output($result);
    }

    public function multi_remove_image() {
        $result = false;
        $ids = $this->input->post('id') ? $this->input->post('id') : '';

        $ids = explode(',',$ids);

        if (empty($ids)) {
            $this->output->append_output($result);
            return;
        }
        foreach ($ids as $id) {
            if ($id) {
                //读取原有数据，用来删除数据后，删除物理文件
                $row = $this->main_model->getOne($id);
                $oldpath = $row->imagepath;

                $result = $this->dataDelete($this->main_model,array('id'=>$id),'id',false);

                //检查文件是否存在
                if (file_exists($oldpath)) {
                    //删除物理文件
                    @unlink($oldpath);
                }
            }
        }
        $this->output->append_output($result);
    }

    public function edit_image() {
        $result = false;
        $id = $this->input->post('id') ? $this->input->post('id') : '';
        $sort = $this->input->post('sort') ? $this->input->post('sort') : '';


        if (!$id) {
            $this->output->append_output($result);
            return;
        }
        $update_image['id'] = $id;
        $update_image['sort'] = $sort;
        $num = $this->dataUpdate($this->main_model,$update_image,false);
        if ($num > 0) {
            $result = true;
        }
        $this->output->append_output($result);
    }
}

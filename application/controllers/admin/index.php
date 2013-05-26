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
 * 后台 引导页管理
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class index extends MY__Controller {

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
        $this->_data['sys_title'] = '北京丰意德家具有限责任公司--引导页管理';
	}


	/**
	 * 转到登录页面
	 */
	public function index() {
        $index = $this->index_model->getOne('1');
        $this->_data['logo'] = $index->logopath;
        $this->_data['info'] = $index->infopath;
        $this->_data['fun'] = 'index';
		$this->load->view('admin/index',$this->_data);
	}

    /**
     * 上传图片
     */
    public function upload_index_logo_image() {

        $type = $this->input->get('type') ? $this->input->get('type') : '';
//        $this->load->library('upload_lib');

        $filepath = $this->upload_lib->upload_file('upload/index');

        //将图片文件信息写入数据库
        if ($filepath) {
            //读取原图，更新后，删除原图
            $index = $this->index_model->getOne('1');
            $oldpath = '';
            $index_image['id'] = '1';
            if ($type == 'logo') {
                $index_image['logopath'] = $filepath;
                $oldpath = $index->logopath;
            }
            else if ($type == 'info') {
                $index_image['infopath'] = $filepath;
                $oldpath = $index->infopath;
            }

            $this->dataUpdate($this->index_model,$index_image,false);

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

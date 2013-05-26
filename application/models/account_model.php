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
 * 帐户操作Model。
 * @package		website
 * @subpackage	Controller
 * @category	Controller
 * @author		blues <blues0118@gmail.com>
 * @link
 */

class account_model extends MY_Model {

     public $tableName= "v_sys_account";

    /**
     * 构造函数
     */
    public function __construct() {
        parent::__construct();
        log_message('debug', "Account Model Class Initialized");
    }
   /*
	 * 数据验证
	 */
	public  function _validate(){
		return array(
		   array('accountcode','is_unique[sys_account.accountcode]','登陆名称已经存在了，换一个吧'),
		);
	}

    /**
     * 检查是否存在相同{帐户名/邮箱 等}
     *
     * @access public
     * @param varchar - $key {name,mail}
     * @param varchar - $value {帐户名/邮箱}的值
     * @param varchar - $exclude_id 需要排除的id
     * @return boolean - success/failure
     */
    public function check_exist($key = 'accountcode',$value = '', $exclude_id = '') {
        //如果值不为空
        if(!empty($value)) {
            $this->db->select('id')->from(self::TABLE_NAME)->where($key, $value);

            //如果要排除的id不为空
            if(!empty($exclude_id)) {
                $this->db->where('id <>', $exclude_id);
            }

            $query = $this->db->get();
            $num = $query->num_rows();

            $query->free_result();

            return ($num > 0) ? TRUE : FALSE;
        }

        return FALSE;
    }

    /**
     * 检查用户是否通过验证
     * @param $accountcode  帐户名
     * @param $password     密码
     * @return bool         boolean / array
     */
    public function validate_account($accountcode,$password) {

        $data = $this->getOneByWhere($where = array ("accountcode"=>$accountcode), $field = array (), $order = array ());
        if(!empty($data)){
            $data = (Common::hash_Validate($password, $data->password)) ? $data : FALSE;
        }
//        $query->free_result();
        return $data;
    }
}

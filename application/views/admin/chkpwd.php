<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("admin/common/header"); ?>
<?php $this->load->view("admin/common/topmenu"); ?>

<?php $this->load->view('admin/common/leftmenu'); ?>
	    <div class="content">
        <div class="container-fluid">
            <div id="pad-wrapper">
                <div class="table-products section">
                    <div class="row-fluid head">
                        <div class="span12">
                            <h4>账户管理<small>密码修改</small></h4>
                        </div>
                    </div>
                  
                    
                </div>
            </div>
        </div>
        <div class="row" style="margin-left: 60px;">
            <div class="span8 column" style="margin-top: 80px;">
                <form id="form" class="form-horizontal" action="<?php echo site_url('a/user/dochkpwd') ?>" method="post">
                    <fieldset>
                        <div class="control-group">
                            <label for="input01" class="control-label">密码</label>

                            <div class="controls">
                                <input type="password" id="pwd1" name="password" class="input-xlarge" value="">
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label for="input01" class="control-label">确认密码</label>

                            <div class="controls">
                                <input type="password" id="pwd2" name="password2" class="input-xlarge" value="">
                            </div>
                        </div>
                       
                        
                        <div class="form-actions">
                            <button id="sub" class="btn btn-primary" type="button">修改密码</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <script>
     $("#sub").click(function(){
    	 if($("#pwd1").val() !=$("#pwd2").val()){
    		 openalert("两次密码输入不一致");
         	 return false;
         }else{
        	 $("#form").submit();
         }
     });
    </script>
<?php $this->load->view('admin/common/footer.php');
<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("admin/common/header"); ?>
<?php $this->load->view("admin/common/topmenu"); ?>

<!--    <script type="text/javascript" src="--><?php //echo base_url('plugins/plupload/js/plupload.full.js') ?><!--"></script>-->
<!--    <script type="text/javascript" src="--><?php //echo base_url('plugins/plupload/js/i18n/zh-cn.js') ?><!--"></script>-->

    <?php $this->load->view('admin/common/leftmenu'); ?>
    <!-- main container -->
    <div class="content">
        <div class="pointer">
            <div class="arrow"></div>
            <div class="arrow_border"></div>
        </div>
        <div class="container-fluid">
            <!-- tabs to navigate through forms related pages -->
           
            <div id="pad-wrapper" class="new-user">
                <div class="row-fluid header">
                    <div class="span8">
                         <h3>分店添加</h3>
                    </div>
<!--                    <a class="btn-flat gray pull-right wid" style=" margin-left: 10px;" >-->
<!--                       <i class="icon-plus"> 添加照片墙 </i>-->
<!--                    </a>-->
<!--                     <a class="btn-flat white pull-right wid">-->
<!--                       <i class="icon-plus"> 添加分店</i>-->
<!--                    </a>-->
                </div>
                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span12 with-sidebar">
                        <div class="container">
                            <form class="new_user_form inline-input" method="post" action="<?php echo site_url("a/store/doAddstore")?>">
                                <div class="span12 field-box">
                                    <label>分类:</label>
                                    <div class="ui-select">
                                      <select name="typeid" >
                                         <?php foreach($list as $key=>$val):?>
                                             <option value="<?php echo $val->id ?>" ><?php echo $val->storescode ?> </option>
                                         <?php endforeach;?>
                                      </select>
                                    </div>
                                </div>
                                <div class="span12 field-box">
                                    <label>标题:</label>
                                    <div class="span9" style="margin:0; padding:0"> 
                                    <textarea class="span9"  name="title" id="title"></textarea></div>
                                </div>
                                <div class="span12 field-box">
                                    <label>内容:</label>
                                    <div class="span9" style="margin:0; padding:0"> 
                                    <textarea class="span9"  name="content" id="content"></textarea></div>
                                </div>
                                
                                <div class="span11 field-box actions">
                                    <input type="submit" class="btn-glow primary" value="添加分店	">
                                    &nbsp;
                                    <a class="btn-flat white pull-right wid" href="<?php echo site_url('a/store/storeList')?>">
                                               <i class="icon-arrow-left"> 取消添加 </i>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    CKEDITOR.replace( 'title' );
    CKEDITOR.replace( 'content' );
    $('#datepic').datepicker().on('changeDate', function(ev) {
		$(this).datepicker('hide')
     });
    </script>
    <!-- end main container -->
<?php $this->load->view('admin/common/footer.php');
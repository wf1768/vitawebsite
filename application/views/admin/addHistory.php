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
                         <h3>历史添加</h3>
                    </div>
<!--                    <a class="btn-flat gray pull-right wid" style=" margin-left: 10px;" >-->
<!--                       <i class="icon-plus"> 添加照片墙 </i>-->
<!--                    </a>-->
<!--                     <a class="btn-flat white pull-right wid">-->
<!--                       <i class="icon-plus"> 添加历史 </i>-->
<!--                    </a>-->
                </div>
                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span12 with-sidebar">
                        <div class="container">
                            <form class="new_user_form inline-input" method="post" action="<?php echo site_url("a/about/doAddYearContent")?>">
                                <div class="span12 field-box">
                                    <label>年份:</label>
                                   <div class="ui-select">
                                <select name="year" >
                                 <?php for($i=date("Y"); $i>1880;$i--):?>
                                 <?php if(in_array($i." 年", $years)) continue;?>
                                    <option><?php echo $i ?> 年</option>
                                 <?php endfor;?>
                                </select>
                            </div>
                                </div>
                                <div class="span12 field-box">
                                    <label>内容:</label>
                                    <div class="span9" style="margin:0; padding:0"> 
                                    <textarea class="span9"  name="content" id="editor1"></textarea></div>
                                </div>
                                
                                <div class="span11 field-box actions">
                                    <input type="submit" class="btn-glow primary" value="添加历史	">
                                    &nbsp;
                                    <a class="btn-flat white pull-right wid" href="<?php echo site_url('a/about/historyList')?>">
                                               <i class="icon-arrow-left"> 取消修改 </i>
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
    CKEDITOR.replace( 'editor1' );
    $('#datepic').datepicker().on('changeDate', function(ev) {
		$(this).datepicker('hide')
     });
    </script>
    <!-- end main container -->
<?php $this->load->view('admin/common/footer.php');
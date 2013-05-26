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
                         <h3>修改历史信息</h3>
                    </div>
                </div>
                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span12 with-sidebar">
                        <div class="container">
                            <form class="new_user_form inline-input" method="post" action="<?php echo site_url("a/about/doUpdHistory")?>">
                                <input name="id" value="<?php echo $info->id?>" type="hidden">
                                <div class="span12 field-box">
                                    <label>年份:</label>
                                <input class="span4" name="year"  readonly value="<?php echo $info->year?>">
                                </div>
                                <div class="span12 field-box">
                                    <label>内容:</label>
                                    <div class="span9" style="margin:0; padding:0"> 
                                    <textarea class="span9"  name="content" id="editor1">
                                     <?php echo $info->content?>
                                    </textarea></div>
                                </div>
                                
                                <div class="span11 field-box actions">
                                    <input type="submit" class="btn-glow primary" value="修改信息	">
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
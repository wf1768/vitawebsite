<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("admin/common/header"); ?>
<?php $this->load->view("admin/common/topmenu"); ?>

    <?php $this->load->view('admin/common/leftmenu'); ?>
    <!-- main container -->
    <div class="content">
        <div class="container-fluid">
            <div class="gallery" id="pad-wrapper">
                <!-- blank state -->
                <div class="no-gallery">
                    <div class="row-fluid header">
                        <h3>引导页企业logo、品牌图片</h3>
                    </div>
                    <div class="center" style="width: 82%">
                        <img src="<?php echo base_url().$logo ?>" >
                        <h6>引导页企业logo、品牌图片</h6>
                        <p>只能上传一张图片，上传图片将覆盖原有图片。图片尺寸为XXX.图片大小尽量在200k以内。</p>
                        <a class="btn-glow primary" onclick="upload_single('<?php echo base_url() ?>','a/index/upload_index_logo_image?type=logo')"><i class="icon-upload-alt"></i>上传图片</a>
                    </div>
                </div>
                <!-- end blank state -->
                <!-- blank state -->
                <div class="no-gallery">
                    <div class="row-fluid header">
                        <h3>引导页 底部说明</h3>
                    </div>
                    <div class="center" style="width: 82%">
                        <img src="<?php echo base_url().$info ?>" >
                        <h6>引导页 底部说明图片</h6>
                        <p>只能上传一张图片，上传图片将覆盖原有图片。图片尺寸为XXX.图片大小尽量在200k以内。</p>
                        <a class="btn-glow primary" onclick="upload_single('<?php echo base_url() ?>','a/index/upload_index_logo_image?type=info')"><i class="icon-upload-alt"></i>上传图片</a>
                        <!--                        <a class="btn-glow primary" onclick="upload_pic('logo')">上传图片</a>-->
                    </div>
                </div>
                <!-- end blank state -->
            </div>
        </div>
    </div>
<?php $this->load->view('admin/common/footer.php');
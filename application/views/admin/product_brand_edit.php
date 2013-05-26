<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("admin/common/header"); ?>
<?php $this->load->view("admin/common/topmenu"); ?>

<?php $this->load->view('admin/common/leftmenu'); ?>

    <script>
        $(function () {

        })
    </script>
    <div class="content">
        <div class="row" style="margin-left: 60px;">
            <div class="span8 column" style="margin-top: 80px;">
                <form class="form-horizontal" action="<?php echo site_url('a/product_brand/save') ?>" method="post">
                    <fieldset>
                        <input id="brandid" name="brandid" type="hidden" value="<?php echo $brand->id ?>">
                        <input id="typeid" name="typeid" type="hidden" value="<?php echo $typeid ?>">
                        <div class="control-group">
                            <label for="input01" class="control-label">品牌名称</label>

                            <div class="controls">
                                <input type="text" id="brandcode" name="brandcode" class="input-xlarge" value="<?php echo $brand->brandcode ?>">
                                <p class="help-block">
                                    品牌名称只是标示，请填写真实品牌名称。
                                </p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="select01" class="control-label">图片（未获焦点）</label>
                            <div class="controls">
                                <img src="<?php echo base_url().$brand->imagepath ?>" id="" style="background:red;">
                                <a class="btn-glow primary" onclick="upload_single('<?php echo base_url() ?>','a/product_brand/upload_single_image?id=<?php echo $brand->id ?>&type=imagepath')"><i class="icon-upload-alt"></i>上传图片</a>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="select01" class="control-label">图片（获得焦点）</label>
                            <div class="controls">
                                <img src="<?php echo base_url().$brand->imagepathchange ?>" id="">
                                <a class="btn-glow primary" onclick="upload_single('<?php echo base_url() ?>','a/product_brand/upload_single_image?id=<?php echo $brand->id ?>&type=imagepathchange')"><i class="icon-upload-alt"></i>上传图片</a>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="select01" class="control-label">图片（左侧展示）</label>
                            <div class="controls">
                                <img src="<?php echo base_url().$brand->imagepathshow ?>" id="">
                                <a class="btn-glow primary" onclick="upload_single('<?php echo base_url() ?>','a/product_brand/upload_single_image?id=<?php echo $brand->id ?>&type=imagepathshow')"><i class="icon-upload-alt"></i>上传图片</a>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="input01" class="control-label">标题</label>

                            <div class="controls">
                                <textarea class="ckeditor" cols="80" id="title" name="title" rows="10"><?php echo $brand->title ?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="input01" class="control-label">描述</label>

                            <div class="controls">
                                <textarea class="ckeditor" cols="80" id="content" name="content" rows="10"><?php echo $brand->content ?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="input01" class="control-label">排序</label>

                            <div class="controls">
                                <input type="text" id="sort" name="sort" class="input-xlarge" value="<?php echo $brand->sort ?>">
                                <p class="help-block">
                                    商品品牌在页面菜单上的显示顺序，请填写数字。
                                </p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="input01" class="control-label">网址</label>

                            <div class="controls">
                                <input type="text" id="url" name="url" class="input-xlarge" value="<?php echo $brand->url ?>">
                                <p class="help-block">
                                    商品品牌的网址超链接，例如： http://www.baidu.com 。
                                </p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="optionsCheckbox" class="control-label">状态</label>

                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" name="status" id="status_on" value="1" <?php if ($brand->status == 1) {echo 'checked';} ?>>
                                    开启状态，在前台页面上，将显示该商品品牌。
                                </label>
                                <label class="radio">
                                    <input type="radio" name="status" id="status_off" value="0" <?php if ($brand->status == 0) {echo 'checked';} ?>>
                                    未开启状态，在前台页面上，将不显示该商品品牌。
                                </label>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">保存更改</button>
                            <a href="<?php echo site_url('a/product_brand?typeid=').$typeid ?>" class="btn">返回</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
<?php $this->load->view('admin/common/footer.php');
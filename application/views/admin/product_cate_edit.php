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
                <form class="form-horizontal" action="<?php echo site_url('a/product_cate/save') ?>" method="post">
                    <fieldset>
                        <input id="brandid" name="cateid" type="hidden" value="<?php echo $cate->id ?>">
                        <input id="typeid" name="brandid" type="hidden" value="<?php echo $brandid ?>">
                        <input id="typeid" name="typeid" type="hidden" value="<?php echo $typeid ?>">
                        <div class="control-group">
                            <label for="input01" class="control-label">品牌系列名称（英文）</label>

                            <div class="controls">
                                <input type="text" id="catecode" name="catecode" class="input-xlarge" value="<?php echo $cate->catecode ?>">
                                <p class="help-block">
                                    系列名称英文将显示在品牌下，鼠标指向时切换中英文。
                                </p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="select01" class="control-label">品牌系列名称（中文）</label>
                            <div class="controls">
                                <input type="text" id="catecodecn" name="catecodecn" class="input-xlarge" value="<?php echo $cate->catecodecn ?>">
                                <p class="help-block">

                                </p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="input01" class="control-label">标题</label>

                            <div class="controls">
                                <textarea class="ckeditor" cols="80" id="title" name="title" rows="10"><?php echo $cate->title ?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="input01" class="control-label">排序</label>

                            <div class="controls">
                                <input type="text" id="sort" name="sort" class="input-xlarge" value="<?php echo $cate->sort ?>">
                                <p class="help-block">
                                    系列在页面菜单上的显示顺序，请填写数字。
                                </p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="optionsCheckbox" class="control-label">状态</label>

                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" name="status" id="status_on" value="1" <?php if ($cate->status == 1) {echo 'checked';} ?>>
                                    开启状态，在前台页面上，将显示该系列。
                                </label>
                                <label class="radio">
                                    <input type="radio" name="status" id="status_off" value="0" <?php if ($cate->status == 0) {echo 'checked';} ?>>
                                    未开启状态，在前台页面上，将不显示该系列。
                                </label>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">保存更改</button>
                            <a href="<?php echo site_url('a/product_cate?brandid=').$brandid.'&typeid='.$typeid ?>" class="btn">返回</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
<?php $this->load->view('admin/common/footer.php');
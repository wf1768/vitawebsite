<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("admin/common/header"); ?>
<?php $this->load->view("admin/common/topmenu"); ?>

<?php $this->load->view('admin/common/leftmenu'); ?>

<script>
    $(function() {

    })

    function add() {
        $('#add-dialog').modal('show');
        $('#brandcode').focus();
    }

    function add_save() {
        var brandcode = $('#brandcode').val();
        if (brandcode == '') {
            openalert('请输入品牌名称。');
            $('#brandcode').focus();
            return;
        }
        var formData = $("#add-form").serialize();

        $.ajax({
            type:"post",
            data: formData,
            url:"<?php echo site_url('a/product_brand/add')?>",
            success: function(data){
                if (data) {
                    window.location.reload();
                }
                else {
                    openalert("没有数据被更新或修改出错，请重新尝试或与管理员联系。");
                }
            },
            error: function() {
                openalert("执行操作出错，请重新尝试或与管理员联系。");
            }
        });
    }

    function remove(id) {
        bootbox.confirm("确定要删除选择的商品品牌吗？<br> <font color='red'>" +
            "注意：删除品牌将同时删除品牌包含的商品系列及所有该商品包含的轮播图片，操作不可恢复，请谨慎操作。</font> ", function(result) {
            if(result){
                $.ajax({
                    type:"post",
                    data: "id=" + id,
                    url:"<?php echo site_url('a/product_brand/remove')?>",
                    success: function(data){
                        if (data) {
                            window.location.reload();
                        }
                        else {
                            openalert("删除图片出错，请重新尝试或与管理员联系。");
                        }
                    },
                    error: function() {
                        openalert("执行操作出错，请重新尝试或与管理员联系。");
                    }
                });
            }
        })
    }

</script>
    <div id="add-dialog" class="modal hide fade" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            添加品牌
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="add-form">
                <!-- /control-group -->
                <div class="control-group">
                    <label class="control-label" for="factory">品牌名称</label>
                    <div class="controls">
                        <input type="hidden" id="typeid" name="typeid" value="<?php echo $typeid ?>">
                        <input type="text" id="brandcode" name="brandcode" value="">
                    </div>
                    <br>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
            <a href="javascript:;" id="" onclick="add_save()" class="btn btn-primary">保存</a>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div id="pad-wrapper">
                <div class="table-products section">
                    <div class="row-fluid head">
                        <div class="span12">
                            <h4>商品类别 <small>/ <?php echo $typecode ?> / 品牌列表</small></h4>
                        </div>
                    </div>
                    <div class="row-fluid filter-block">
                        <div class="pull-right">
                            <a class="btn-flat new-product" onclick="add()"><i class="icon-ok"></i> 添加品牌</a>
                            <a class="btn-flat new-product" href="<?php echo site_url('a/product_type') ?>" ><i class="icon-reply"></i> 返回</a>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th >品牌名称</th>
                                    <th >图片（未获焦点）</th>
                                    <th >图片（获得焦点）</th>
                                    <th >图片（左侧展示）</th>
<!--                                    <th >标题</th>-->
<!--                                    <th >描述</th>-->
                                    <th >排序</th>
                                    <th >网址</th>
                                    <th ><span class="line"></span>状态</th>
                                    <th ><span class="line"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($list)):?>
                                <?php foreach($list as $row):?>
                                    <tr>
                                        <td><?php echo $row->brandcode ?></td>
                                        <td><img src="<?php echo base_url($row->imagepath) ?>"></td>
                                        <td><img src="<?php echo base_url($row->imagepathchange) ?>"></td>
                                        <td><img src="<?php echo base_url($row->imagepathshow) ?>"></td>
<!--                                        <td>--><?php //echo $row->title ?><!--</td>-->
<!--                                        <td>--><?php //echo $row->content ?><!--</td>-->
                                        <td><?php echo $row->sort ?></td>
                                        <td><?php echo $row->url ?></td>
                                        <td><?php echo ($row->status == 0)? '<span class="label label-important">未启用</span>':'<span class="label label-success">已启用</span>' ?></td>
                                        <td>
                                            <ul class="actions">
                                                <li><a href="<?php echo site_url('a/product_brand/edit?id='.$row->id.'&typeid='.$typeid) ?>" title="修改" ><i class="icon-edit"></i></a></li>
                                                <li><a href="<?php echo site_url('a/product_image?whoid='.$row->id.'&who=brand&typeid='.$typeid) ?>" title="轮播图片" ><i class="icon-picture"></i></a></li>
                                                <li><a href="<?php echo site_url('a/product_cate?brandid='.$row->id.'&typeid='.$typeid) ?>" title="商品系列管理" ><i class="icon-sitemap"></i></a></li>
                                                <li class="last"><a href="javascript:;" title="删除" onclick="remove('<?php echo $row->id ?>')"><i class="icon-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="span4" style="margin-top:20px ">
                            <?php echo (isset($info))?$info:'' ?>
                        </div>
                        <div class=" pagination pagination-right">
                            <?php
                            echo (isset($page))?$page:'';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('admin/common/footer.php');
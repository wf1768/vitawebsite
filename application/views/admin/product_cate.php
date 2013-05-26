<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("admin/common/header"); ?>
<?php $this->load->view("admin/common/topmenu"); ?>

<?php $this->load->view('admin/common/leftmenu'); ?>

<script>
    $(function() {

    })

    function add() {
        $('#add-dialog').modal('show');
        $('#catecode').focus();
    }

    function add_save() {
        var catecode = $('#catecode').val();
        if (catecode == '') {
            openalert('请输入系列名称。');
            $('#catecode').focus();
            return;
        }
        var formData = $("#add-form").serialize();

        $.ajax({
            type:"post",
            data: formData,
            url:"<?php echo site_url('a/product_cate/add')?>",
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
        bootbox.confirm("确定要删除选择的商品系列吗？<br> <font color='red'>" +
            "注意：删除商品系列将同时删除系列包含的轮播图片，操作不可恢复，请谨慎操作。</font> ", function(result) {
            if(result){
                $.ajax({
                    type:"post",
                    data: "id=" + id,
                    url:"<?php echo site_url('a/product_cate/remove')?>",
                    success: function(data){
                        if (data) {
                            window.location.reload();
                        }
                        else {
                            openalert("删除系列出错，请重新尝试或与管理员联系。");
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
            添加系列
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="add-form">
                <input type="hidden" id="brandid" name="brandid" value="<?php echo $brandid ?>">
                <!-- /control-group -->
                <div class="control-group">
                    <label class="control-label" for="catecode">品牌系列名称（英文)</label>
                    <div class="controls">
                        <input type="text" id="catecode" name="catecode" value="">
                    </div>
                    <br>
                </div>
                <div class="control-group">
                    <label class="control-label" for="factory">品牌系列名称（中文)</label>
                    <div class="controls">

                        <input type="text" id="catecodecn" name="catecodecn" value="">
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
                            <h4>商品类别 <small>/ <?php echo $typecode ?> / <?php echo $brandcode ?> / 品牌系列</small></h4>
                        </div>
                    </div>
                    <div class="row-fluid filter-block">
                        <div class="pull-right">
                            <a class="btn-flat new-product" onclick="add()"><i class="icon-ok"></i> 添加系列</a>
                            <a class="btn-flat new-product" href="<?php echo site_url('a/product_brand?typeid=').$typeid ?>" ><i class="icon-reply"></i> 返回</a>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th >品牌系列名称（英文）</th>
                                    <th >品牌系列名称（中文）</th>
                                    <th >排序</th>
                                    <th ><span class="line"></span>状态</th>
                                    <th ><span class="line"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($list)):?>
                                <?php foreach($list as $row):?>
                                    <tr>
                                        <td><?php echo $row->catecode ?></td>
                                        <td><?php echo $row->catecodecn ?></td>
                                        <td><?php echo $row->sort ?></td>
                                        <td><?php echo ($row->status == 0)? '<span class="label label-important">未启用</span>':'<span class="label label-success">已启用</span>' ?></td>
                                        <td>
                                            <ul class="actions">
                                                <li><a href="<?php echo site_url('a/product_cate/edit?id='.$row->id.'&brandid='.$brandid.'&typeid='.$typeid) ?>" title="修改" ><i class="icon-edit"></i></a></li>
                                                <li><a href="<?php echo site_url('a/product_image?whoid='.$row->id.'&who=cate&typeid='.$typeid) ?>" title="轮播图片" ><i class="icon-picture"></i></a></li>
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
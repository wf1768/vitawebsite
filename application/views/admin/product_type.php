<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("admin/common/header"); ?>
<?php $this->load->view("admin/common/topmenu"); ?>

<?php $this->load->view('admin/common/leftmenu'); ?>

<script>
    $(function() {
    })

    function edit(id,status) {
        if (id == '') {
            return;
        }

        if (status == 0) {
            $("input[name=status][value='0']").attr("checked",'checked');
        }
        else {
            $("input[name=status][value='1']").attr("checked",'checked');
        }


//        $('input[name="testradio"]:checked').val();
        $('#id').val(id);
//        $('#status').val(status);
        $('#edit-dialog').modal('show');
    }

    function save() {
//        var status =$('input[name="status"]:checked').val();
        var formData = $("#edit-form").serialize();
        $.ajax({
            type:"post",
            data: formData,
            url:"<?php echo site_url('a/product_type/edit_status')?>",
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
</script>
    <div id="edit-dialog" class="modal hide fade" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            修改
        </div>
        <div class="modal-body">

            <form class="form-horizontal" id="edit-form">
                <!-- /control-group -->
                <div class="control-group">
                    <input type="hidden" id="id" name="id" value="">
                    <label class="radio" style="padding-left: 100px;">
                        <input type="radio" name="status" id="status_on" value="1" checked>
                        开启状态，在前台页面上，将显示该商品分类。
                    </label>
                    <label class="radio" style="padding-left: 100px;">
                        <input type="radio" name="status" id="status_off" value="0">
                        未开启状态，在前台页面上，将不显示该商品分类。
                    </label>
                    <!-- /controls -->
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
            <a href="javascript:;" id="uploadfiles" onclick="save()" class="btn btn-primary">保存</a>
        </div>
    </div>
	<!-- main container -->
    <div class="content">
        <div class="container-fluid">
            <div id="pad-wrapper">
                <div class="table-products section">
                    <div class="row-fluid head">
                        <div class="span12">
                            <h4>商品 <small>类别列表</small></h4>
                        </div>
                    </div>
                    <div class="row-fluid filter-block">
                        <div class="pull-right">
                        </div>
                    </div>
                    <div class="row-fluid">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span3">图片（未获焦点）</th>
                                    <th class="span3">图片（获得焦点）</th>
                                    <th class="span1"><span class="line"></span>状态</th>
                                    <th class="span3"><span class="line"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($list)):?>
                                <?php foreach($list as $row):?>
                                    <tr>
                                        <td><img src="<?php echo base_url($row->imagepath) ?>"></td>
                                        <td><img src="<?php echo base_url($row->imagepathchange) ?>"></td>
                                        <td><?php echo ($row->status == 0)? '<span class="label label-important">未启用</span>':'<span class="label label-success">已启用</span>' ?></td>
                                        <td>
                                            <ul class="actions">
                                                <li><a href="javascript:;" onclick="edit('<?php echo $row->id ?>',<?php echo $row->status ?>)" title="修改状态" ><i class="icon-edit"></i></a></li>
                                                <li><a href="<?php echo site_url('a/product_brand?typeid=').$row->id ?>" title="品牌管理" ><i class="icon-sitemap"></i></a></li>
<!--                                                <a class="btn-flat new-product" onclick="edit('--><?php //echo $row->id ?><!--',--><?php //echo $row->status ?><!--)"><i class="icon-flag"></i> 状态管理</a>-->
<!--                                                <a class="btn-flat new-product" href="--><?php //echo site_url('a/product_brand?typeid=').$row->id ?><!--" ><i class="icon-list-alt"></i> 品牌管理</a>-->
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
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

        if (status == '0') {
            $("input[name=status][value='0']").attr("checked",'checked');
        }
        else {
            $("input[name=status][value='1']").attr("checked",'checked');
        }


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
            url:"<?php echo site_url('a/config/edit_status')?>",
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
                        开启状态，在前台页面上，将显示该模块。
                    </label>
                    <label class="radio" style="padding-left: 100px;">
                        <input type="radio" name="status" id="status_off" value="0">
                        未开启状态，在前台页面上，将不显示该模块。
                    </label>
                    <!-- /controls -->
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
            <a href="javascript:;" onclick="save()" class="btn btn-primary">保存</a>
        </div>
    </div>
	<!-- main container -->
    <div class="content">
        <div class="container-fluid">
            <div id="pad-wrapper">
                <div class="table-products section">
                    <div class="row-fluid head">
                        <div class="span12">
                            <h4><small>系统配置列表</small></h4>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>配置项</th>
                                    <th>配置值</th>
                                    <th>配置描述</th>
                                    <th class="span3"><span class="line"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($list)):?>
                                <?php foreach($list as $row):?>
                                    <tr>
                                        <td><?php echo $row->key ?></td>
                                        <td><?php echo ($row->value == 0)? '<span class="label label-important">未启用</span>':'<span class="label label-success">已启用</span>' ?></td>
                                        <td><?php echo $row->memo ?></td>
                                        <td>
                                            <ul class="actions">
                                                <li class="last"><a href="javascript:;" title="状态管理" onclick="edit('<?php echo $row->id ?>','<?php echo $row->value ?>')"><i class="icon-flag"></i></a></li>
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
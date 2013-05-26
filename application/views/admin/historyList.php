<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("admin/common/header"); ?>
<?php $this->load->view("admin/common/topmenu"); ?>
<script>
function multi_remove() {
    var str="";
    $("input[name='checkbox']").each(function(){
        if($(this).attr("checked") == 'checked'){
            str+=$(this).val()+",";
        }
    })
    if (str == "") {
        openalert('请选择要删除的历史。');
        return;
    }
    str = str.substring(0,str.length-1);

    bootbox.confirm("确定要删历史吗？<br> <font color='red'>" +"注意：删除历史操作不可恢复，请谨慎操作。</font> ", function(result) {
        if(result){
            $.ajax({
                type:"post",
                data: "id=" + str,
                url:"<?php echo site_url('a/about/multDelHistory')?>",
                success: function(data){
                    if (data) {
                        window.location.reload();
                    }
                    else {
                        openalert("删除历史出错，请重新尝试或与管理员联系。");
                    }
                },
                error: function() {
                    openalert("执行操作出错，请重新尝试或与管理员联系。");
                }
            });
        }
    })
}
function single_remove(id) {
    bootbox.confirm("确定要删除选择的历史吗？<br> <font color='red'>" +
        "注意：删除历史操作不可恢复，请谨慎操作。</font> ", function(result) {
        if(result){
            $.ajax({
                type:"post",
                data: "id=" + id,
                url:"<?php echo site_url('a/about/singleDelHistory')?>",
                success: function(data){
                    if (data) {
                        window.location.reload();
                    }
                    else {
                        openalert("删除历史出错，请重新尝试或与管理员联系。");
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
<!--    <link type="text/css" href="--><?php //echo base_url('plugins/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css') ?><!--" rel="stylesheet">-->
<!---->
<!--    <script type="text/javascript" src="--><?php //echo base_url('plugins/plupload/js/plupload.full.js') ?><!--"></script>-->
<!--    <script type="text/javascript" src="--><?php //echo base_url('plugins/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js') ?><!--"></script>-->
<!--    <script type="text/javascript" src="--><?php //echo base_url('plugins/plupload/js/i18n/zh-cn.js') ?><!--"></script>-->
    <?php $this->load->view('admin/common/leftmenu'); ?>
    <div id="edit-dialog" class="modal hide fade" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            修改
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="edit-form">
                <!-- /control-group -->
                <div class="control-group">
                    <label class="control-label" for="factory">历史排序</label>
                    <div class="controls">
                        <input type="hidden" id="id" name="id" value="">
                        <input type="text" id="sort" name="sort" onkeypress="return isnumber(event)" value="">
                    </div>
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
                            <h4>关于我们<small>历史列表</small></h4>
                        </div>
                    </div>
                    <div class="row-fluid filter-block">
                        <div class="pull-right">
                            <a class="btn-flat new-product" href="<?php echo site_url('a/about/addYearContent') ?>"><i class="icon-plus">  添加历史</i></a>
                            <a class="btn-flat new-product" onclick="multi_remove()" title="批量删除"> 
                                <i class="icon-minus"> 批量删除</i>
                            </a>
                            <a class="btn-flat new-product" href="<?php echo site_url("a/marking/markList")?>"> <i class="icon-plus"> 添加照片墙</i></i></a>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span3"><input type="checkbox">历史图片</th>
                                    <th class="span3">年份</th>
                                    <th class="span1"><span class="line"></span>内容</th>
                                    <th class="span3"><span class="line"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($list)):?>
                                <?php foreach($list as $row):?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="checkbox" value="<?php echo $row->id ?>"/>
                                             <a href="<?php echo site_url("a/about/historyPicList?historyid=".$row->id)?>">查看</a>
                                        </td>
                                        <td><?php echo $row->year ?></td>
                                        <td ><?php echo strip_tags(mb_substr($row->content, 0,20,"utf-8"))?>...</td>
                                        <td>
                                            <ul class="actions">
                                                <li><a href="<?php echo site_url("a/about/updHistory?id=".$row->id)?>" title="编辑" ><i class="table-edit"></i></a></li>
                                                <li class="last"><a href="javascript:;" title="删除" onclick="single_remove('<?php echo $row->id ?>')"><i class="table-delete"></i></a></li>
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
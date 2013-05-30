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
        openalert('请选择要删除的分店。');
        return;
    }
    str = str.substring(0,str.length-1);

    bootbox.confirm("确定要删分店吗？<br> <font color='red'>" +"注意：删除分店操作不可恢复，请谨慎操作。</font> ", function(result) {
        if(result){
            $.ajax({
                type:"post",
                data: "id=" + str,
                url:"<?php echo site_url('a/store/multDelstore')?>",
                success: function(data){
                    if (data) {
                        window.location.reload();
                    }
                    else {
                        openalert("删除分店出错，请重新尝试或与管理员联系。");
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
    bootbox.confirm("确定要删除选择的分店？<br> <font color='red'>" +
        "注意：删除分店操作不可恢复，请谨慎操作。</font> ", function(result) {
        if(result){
            $.ajax({
                type:"post",
                data: "id=" + id,
                url:"<?php echo site_url('a/store/singleDelstore')?>",
                success: function(data){
                    if (data) {
                        window.location.reload();
                    }
                    else {
                        openalert("删除分店出错，请重新尝试或与管理员联系。");
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
                    <label class="control-label" for="factory">分店排序</label>
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
                            <h4>分店管理<small>分店列表</small></h4>
                        </div>
                    </div>
                    <div class="row-fluid filter-block">
                        <div class="pull-right">
                            <a class="btn-flat new-product" href="<?php echo site_url('a/store/addStore') ?>"><i class="icon-plus">  添加分店</i></a>
                            <a class="btn-flat new-product" onclick="multi_remove()" title="批量删除"> 
                                <i class="icon-minus"> 批量删除</i>
                            </a>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span3"><input type="checkbox"></th>
                                    <th class="span3">分类</th>
                                    <th class="span3">标题</th>
                                    <th class="span3">内容</th>
                                    <th class="span3"><span class="line"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($list)):?>
                                <?php foreach($list as $row):?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="checkbox" value="<?php echo $row->id ?>"/>
                                            
                                        </td>
                                        <td><?php echo store::getType($row->typeid) ?></td>
                                        <td ><?php echo strip_tags(mb_substr($row->title, 0,20,"utf-8"))	 ?></td>
                                        <td ><?php echo strip_tags(mb_substr($row->content, 0,20,"utf-8"))	 ?></td>
                                        <td>
                                            <ul class="actions">
                                            <li> <a title="图片" href="<?php echo site_url("a/store/storePicList?storesid=".$row->id)?>"><i class="icon-picture"></i></a></li>
                                                <li><a href="<?php echo site_url("a/store/updstore?id=".$row->id)?>" title="编辑" ><i class="icon-edit"></i></a></li>
                                                <li class="last"><a href="javascript:;" title="删除" onclick="single_remove('<?php echo $row->id ?>')"><i class="icon-trash"></i></a></li>
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
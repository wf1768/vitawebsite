<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("admin/common/header"); ?>
<?php $this->load->view("admin/common/topmenu"); ?>

<!--    <link type="text/css" href="-->
<?php //echo base_url('plugins/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css') ?>
<!--" rel="stylesheet">-->
<!---->
<!--    <script type="text/javascript" src="-->
<?php //echo base_url('plugins/plupload/js/plupload.full.js') ?>
<!--"></script>-->
<!--    <script type="text/javascript" src="-->
<?php //echo base_url('plugins/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js') ?>
<!--"></script>-->
<!--    <script type="text/javascript" src="-->
<?php //echo base_url('plugins/plupload/js/i18n/zh-cn.js') ?>
<!--"></script>-->
<?php $this->load->view('admin/common/leftmenu'); ?>
<script>
    $(function() {
        $("a[data-toggle=popover]").popover();
        $("input[type='checkbox']").attr("checked",false);
    })

    function single_remove(id) {
        bootbox.confirm("确定要删除选择的首页轮播图片吗？<br> <font color='red'>" +
            "注意：删除图片操作不可恢复，请谨慎操作。</font> ", function(result) {
            if(result){
                $.ajax({
                    type:"post",
                    data: "id=" + id,
                    url:"<?php echo site_url('a/press/single_remove_image')?>",
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

    function multi_remove() {
        var str="";
        $("input[name='checkbox']").each(function(){
            if($(this).attr("checked") == 'checked'){
                str+=$(this).val()+",";
            }
        })
        if (str == "") {
            openalert('请选择要删除的采购单。');
            return;
        }
        str = str.substring(0,str.length-1);

        bootbox.confirm("确定要删除选择的首页轮播图片吗？<br> <font color='red'>" +
            "注意：删除图片操作不可恢复，请谨慎操作。</font> ", function(result) {
            if(result){
                $.ajax({
                    type:"post",
                    data: "id=" + str,
                    url:"<?php echo site_url('a/press/multi_remove_image')?>",
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

    function edit(id,sort) {
        if (id == '') {
            return;
        }
        $('#id').val(id);
        $('#sort').val(sort);
        $('#edit-dialog').modal('show');
    }

    function save() {
        var sort = $('#sort').val();
        if (sort == '') {
            openalert('请输入排序值。');
            $('#sort').focus();
            return;
        }
        var formData = $("#edit-form").serialize();

        $.ajax({
            type:"post",
            data: formData,
            url:"<?php echo site_url('a/press/edit_image')?>",
            success: function(data){
                if (data) {
                    window.location.reload();
                }
                else {
                    openalert("没有数据被更新或修改图片出错，请重新尝试或与管理员联系。");
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
<button type="button" class="close" data-dismiss="modal"
	aria-hidden="true">×</button>
修改</div>
<div class="modal-body">
<form class="form-horizontal" id="edit-form"><!-- /control-group -->
<div class="control-group"><label class="control-label" for="factory">图片排序</label>
<div class="controls"><input type="hidden" id="id" name="id" value=""> <input
	type="text" id="sort" name="sort" onkeypress="return isnumber(event)"
	value=""></div>
<!-- /controls --></div>
</form>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
<a href="javascript:;" id="uploadfiles" onclick="save()"
	class="btn btn-primary">保存</a></div>
</div>

<!-- main container -->
<div class="content">
<div class="container-fluid">
<div id="pad-wrapper">
<div class="table-products section">
<div class="row-fluid head">
<div class="span12">
<h4>新闻<small>新闻图片列表</small></h4>
</div>
</div>
<div class="row-fluid filter-block">
<div class="pull-right"><a class="btn-flat new-product"
	onclick="upload_multi('<?php echo base_url() ?>','a/press/upload_image?pressid=<?php echo trim($_GET['pressid'])?>'	)">+
添加图片</a> <a class="btn-flat new-product" onclick="multi_remove()">- 删除图片</a>
</div>
</div>
<div class="row-fluid">
<table class="table table-hover">
	<thead>
		<tr>
			<th class="span3"><input type="checkbox">图片</th>
			<th class="span3">图片地址</th>
			<th class="span1"><span class="line"></span>排序</th>
			<th class="span3"><span class="line"></span></th>
		</tr>
	</thead>
	<tbody>
	<?php if(isset($list)):?>
	<?php foreach($list as $row):?>
		<tr>
			<td><input type="checkbox" name="checkbox"
				value="<?php echo $row->id ?>" /> <a href="javascript:;"
				data-html="true" data-trigger="hover" data-toggle="popover"
				data-content="<img src='<?php echo base_url($row->imagepath) ?>' />">

			<img src="<?php echo base_url($row->imagepath) ?>"
				class="thumbnail smallImg" /> </a></td>
			<td><?php echo $row->imagepath ?></td>
			<td><?php echo $row->sort ?></td>
			<td>
			<ul class="actions">
				<li><a href="javascript:;" title="修改排序"
					onclick="edit('<?php echo $row->id ?>',<?php echo $row->sort ?>)"><i
					class="table-edit"></i></a></li>
				<li class="last"><a href="javascript:;" title="删除"
					onclick="single_remove('<?php echo $row->id ?>')"><i
					class="table-delete"></i></a></li>
			</ul>
			</td>
		</tr>
		<?php endforeach;?>
		<?php endif;?>
	</tbody>
</table>
</div>
<div class="row">
<div class="span4" style="margin-top: 20px"><?php echo (isset($info))?$info:'' ?>
</div>
<div class=" pagination pagination-right"><?php
echo (isset($page))?$page:'';
?></div>
</div>
</div>
</div>
</div>
</div>
<?php $this->load->view('admin/common/footer.php');
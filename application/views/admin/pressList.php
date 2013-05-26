<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("admin/common/header"); ?>
<?php $this->load->view("admin/common/topmenu"); ?>

<script>
    $(function() {
        $("a[data-toggle=popover]").popover();
    })

function multi_remove() {
    var str="";
    $("input[name='checkbox']").each(function(){
        if($(this).attr("checked") == 'checked'){
            str+=$(this).val()+",";
        }
    })
    if (str == "") {
        openalert('请选择要删除的新闻。');
        return;
    }
    str = str.substring(0,str.length-1);

    bootbox.confirm("确定要删新闻吗？<br> <font color='red'>" +"注意：删除新闻操作不可恢复，请谨慎操作。</font> ", function(result) {
        if(result){
            $.ajax({
                type:"post",
                data: "id=" + str,
                url:"<?php echo site_url('a/press/multDelpress')?>",
                success: function(data){
                    if (data) {
                        window.location.reload();
                    }
                    else {
                        openalert("删除新闻出错，请重新尝试或与管理员联系。");
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
    bootbox.confirm("确定要删除选择的新闻吗？<br> <font color='red'>" +
        "注意：删除新闻操作不可恢复，请谨慎操作。</font> ", function(result) {
        if(result){
            $.ajax({
                type:"post",
                data: "id=" + id,
                url:"<?php echo site_url('a/press/singleDelpress')?>",
                success: function(data){
                    if (data) {
                        window.location.reload();
                    }
                    else {
                        openalert("删除新闻出错，请重新尝试或与管理员联系。");
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
    <?php $this->load->view('admin/common/leftmenu'); ?>
	<!-- main container -->
    <div class="content">
        <div class="container-fluid">
            <div id="pad-wrapper">
                <div class="table-products section">
                    <div class="row-fluid head">
                        <div class="span12">
                            <h4>新闻<small>新闻列表</small></h4>
                        </div>
                    </div>
                    <div class="row-fluid filter-block">
                        <div class="pull-right">
                            <a class="btn-flat new-product" href="<?php echo site_url('a/press/addPress') ?>"><i class="icon-plus">  添加新闻</i></a>
                            <a class="btn-flat new-product" onclick="multi_remove()" title="批量删除"> 
                                <i class="icon-minus"> 批量删除</i>
                            </a>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span3"><input type="checkbox">新闻图册</th>
                                    <th class="span3" >新闻封面</th>
                                    <th class="span1"><span class="line"></span>新闻标题</th>
                                    <th class="span3"><span class="line"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($list)):?>
                                <?php foreach($list as $row):?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="checkbox" value="<?php echo $row->id ?>"/>
                                            <a href="<?php echo site_url("a/press/pressPicList?pressid=".$row->id)?>">查看</a>
                                        </td>
                                        <td >
                                        
                                           <?php if($row->image !=""):?>
                                             <a href="javascript:;"data-html="true" data-trigger="hover" data-toggle="popover"data-content="<img src='<?php echo base_url($row->image) ?>' />">
                                                 <img src="<?php echo base_url($row->image) ?>"class="thumbnail smallImg" /> 
                                             </a>
                                           <?php endif;?>
                                       
                                          <a style="margin: -23px 0 0;" onclick="upload_single('<?php echo base_url() ?>','a/press/upload_face_image?id=<?php echo $row->id?>')" class="btn-flat new-product">
                                          <i class="icon-plus"> </i>
                                          </a>
                                        </td>
                                        <td title="<?php echo $row->content?>"><?php echo mb_substr($row->title, 0,20,"utf-8")	 ?></td>
                                        <td>
                                            <ul class="actions">
                                                <li><a href="<?php echo site_url("a/press/updpress?id=".$row->id)?>" title="编辑" ><i class="table-edit"></i></a></li>
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
    <<style>
<!--

element.style {
    height: 12px;
    margin: 0;
}
.table-products .table td a {
    display: inline-block;
    margin-top: 6px;
}
.btn-flat, .btn-flat.default {
    background: none repeat scroll 0 0 #4387BF;
    border: 1px solid #3883C0;
    border-radius: 4px 4px 4px 4px;
    box-shadow: none;
    color: #FFFFFF;
    cursor: pointer;
    display: inline-block;
    font-size: 12px;
    font-weight: 900;
    line-height: 15px;
    margin: 0;
    padding: 0 6px;
    text-shadow: none;
    transition: all 0.1s linear 0s;
    vertical-align: middle;
}
-->
</style>
<?php $this->load->view('admin/common/footer.php');
<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("website/common/header"); ?>

<style type="text/css">
    .p1{color: #050505;}
    .p2{color: #050505;}
    .p3{color: #E69A42;}
    .p4{color: #E69A42;}
</style>

<script type="text/javascript">
    function initFormCSS()
    {
        var winHeight = $(window).innerHeight();
        var bottomHeight = $('.main_footer').innerHeight();
        var topHeight = $('.top').innerHeight();
        var menu_topHeight = $('.menu_top').innerHeight();
        var mid_topHeight = $('.mid_top').innerHeight();
        if (mid_topHeight == null) {
            mid_topHeight = 0;
        }
        $('.left_menu').css({
            "height": winHeight - bottomHeight - topHeight - menu_topHeight - mid_topHeight,
            "top": 0
        });

        //调整.main的top
        $('.main').css({
            'top':topHeight + menu_topHeight + mid_topHeight
        })
    }
    $(window).resize(function(){
        initFormCSS();
    });

    $(function(){

        var slidersArr = new Array();
        <!-- 注意，这种将php数组转为javascript数组，可能有中文问题。-->
        var tmp = <?php echo json_encode($product_image);?>;

        for (var i=0;i<tmp.length;i++) {
            slidersArr[i] = {'image':'<?php echo base_url() ?>' + tmp[i].imagepath};
        }

        if (slidersArr.length > 0) {
            params.slides = slidersArr;
            $.supersized(params);
        }

        initFormCSS();

        //菜单状态切换
        initFurniture();
        initHousewares();
        catagroyContent();

        productsInfo();
        set_brand();

    });
    //将当前品牌logo改变样式
    function set_brand() {
        //将当前品牌logo改变样式
        var selid = '<?php echo $product_brand->id ?>';
        $('#' + selid).find(".n1").css({"display":"none"});
        $('#' + selid).find(".n2").css({"display":"block"});

        var type = '<?php echo $product_brand->typeid ?>';
        if (type == '1') {
            $("#furniture").find(".n1").css("display","none");
            $("#furniture").find(".n2").css("display","block");
        }
        else if (type=='2') {
            $("#housewares").find(".n1").css("display","none");
            $("#housewares").find(".n2").css("display","block");
        }
        else {

        }

        $('.content').css({"display":"none"});
        $('.content_default').css({"display":"none"});

        var type = '<?php echo $type ?>';
        if (type == 'brand') {
            $('.content').css({"display":"block"});
        }
        else if (type=='cate') {
            $("#identity").css({"color":"#000000"});
            $("#product").css({"color":"#F08D39"});
            var cateid = '<?php
                if ($product_cate) {
                    echo $product_cate->id;
                }
                ?>';
            selProduct(cateid);
            //隐藏品牌说明。打开系列说明
//            $('.content').css({"display":"none"});
            $('.content_default').css({"display":"block"});
        }
        else {

        }
    }

</script>

<!--主内容start-->
<div id="container">
    <?php $this->load->view("website/common/top"); ?>
    <div class="main">
        <div class="left_menu">
            <dl>
                <dt><img id="currentBrand" src="<?php echo base_url($product_brand->imagepathshow) ?>" /></dt><!-- 当前品牌图片 -->
                <dd id="identity" class="yellow">IDENTITY</dd>
                <dd id="product">PRODUCTS</dd>
                <dd>
                    <ul id="products">
                        <?php if ($product_cates) : ?>
                            <?php foreach ($product_cates as $cate) : ?>
                                <li id="<?php echo $cate->id ?>">
                                    <a href="<?php echo site_url('w/product/product_get').'?brandid='.$product_brand->id.'&type=cate&cateid='.$cate->id ?>"><p class="p1">-<?php echo $cate->catecode ?></p></a>
                                    <a href="<?php echo site_url('w/product/product_get').'?brandid='.$product_brand->id.'&type=cate&cateid='.$cate->id ?>"><p class="p2">-<?php echo $cate->catecodecn ?></p></a>
                                    <a href="<?php echo site_url('w/product/product_get').'?brandid='.$product_brand->id.'&type=cate&cateid='.$cate->id ?>"><p class="p3">-<?php echo $cate->catecode ?></p></a>
                                    <a href="<?php echo site_url('w/product/product_get').'?brandid='.$product_brand->id.'&type=cate&cateid='.$cate->id ?>"><p class="p4">-<?php echo $cate->catecodecn ?></p></a>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>
                    </ul>
                </dd>
            </dl>
            <a href="http://<?php echo $product_brand->url ?>" target="_blank"><p class="left_bottom p2" style="z-index: 6"><?php echo $product_brand->url ?></p></a>
        </div>
        <!-- 展开 z-index: 4;-->
        <div class="content">
            <div class="con_char">
                <div class="con_charle" style="top:0px; position:relative;">
                    <div id="catagroyContent">
                        <!-- 内容 -->
                        <?php echo $product_brand->content ?>
                    </div>
                </div>
            </div>
            <div class="zooms"><img src="<?php echo base_url('public/website/images/sq.png') ?>" width="20" height="14" /></div>
        </div>

        <!-- 收缩 -->
        <div class="content_none">
            <div class="con_none"><?php echo $product_brand->title ?></div>
            <div class="zooms1"><img src="<?php echo base_url('public/website/images/zk.png') ?>" width="20" height="14" /></div>
        </div>
        <div class="content_default">
            <div class="con_default">
                <?php if ($product_cate) {
                    echo $product_cate->title;
                }
                ?>
            </div>
        </div>
        <!--Page Control Bar-->
        <div id="controls-wrapper" class="load-item">
            <!--Navigation-->
            <ul id="slide-list"></ul>
        </div>
    </div>
    <?php $this->load->view("website/common/footer"); ?>
</div>
</body>
</html>


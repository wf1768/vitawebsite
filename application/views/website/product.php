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
            $('.left_menu').css({
                "height": winHeight - bottomHeight - topHeight - menu_topHeight - mid_topHeight,
                "top": 0
            });
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

            params.slides = slidersArr;
//            params.slide_links = 'num';
            $.supersized(params);

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

            var type = '<?php echo $type ?>';
            if (type == 'brand') {
                $("#furniture").find(".n1").css("display","none");
                $("#furniture").find(".n2").css("display","block");
            }
            else if (type=='cate') {
                $("#housewares").find(".n1").css("display","none");
                $("#housewares").find(".n2").css("display","block");
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
                        <?php if ($product_cate) : ?>
                            <?php foreach ($product_cate as $cate) : ?>
                            <li>
                                <p class="p1">-<?php echo $cate->catecode ?></p>
                                <p class="p2">-<?php echo $cate->catecodecn ?></p>
                                <p class="p3">-<?php echo $cate->catecode ?></p>
                                <p class="p4">-<?php echo $cate->catecodecn ?></p>
                            </li>
                            <?php endforeach ?>
                        <?php endif ?>
                    </ul>
                </dd>
            </dl>
            <p class="left_bottom"><?php echo $product_brand->url ?></p>
        </div>
        <!-- 展开 -->
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


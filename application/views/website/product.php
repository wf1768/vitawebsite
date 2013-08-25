<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("website/common/header"); ?>

<style type="text/css">
    .p1{color: #050505;}
    .p2{color: #050505;}
    .p3{color: #E69A42;}
    .p4{color: #E69A42;}
    .pro_p p{margin-left:6px;}
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
            'top':topHeight + menu_topHeight + mid_topHeight+1
        })

        //.left_menu 左边的宽度
        var left_width = 128;
        $('.left_menu').css({"width":left_width});
        var p_width = $(window).width();
		$('.content').css({"width":p_width-left_width});
		$('.content_none').css({"width":p_width-left_width});
		$('#controls-wrapper').css({"width":p_width-left_width});
			        
    }
    $(window).resize(function(){
        initFormCSS();
    });

    $(function(){
    	var product_id = '<?php
    	        echo $brandid;
    	    ?>';
    	if(product_id == "10000"){
    		$('#products').addClass('pro_p');
    	}
    	        
        var slidersArr = new Array();
        <!-- 注意，这种将php数组转为javascript数组，可能有中文问题。-->
        var tmp = <?php echo json_encode($product_image);?>;

        for (var i=0;i<tmp.length;i++) {
//            alert(tmp[i].content);
            if (tmp[i].content == "") {
                slidersArr[i] = {'image':'<?php echo base_url() ?>' + tmp[i].imagepath};
//                alert('11:'+tmp.content);
            }
            else {
                slidersArr[i] = {'image':'<?php echo base_url() ?>' + tmp[i].imagepath,title:tmp[i].content};
//                alert(tmp.content);
            }

        }

        if (slidersArr.length > 0) {
            params.slides = slidersArr;
//            params.slide_interval = 3000;
//            params.transition_speed = 1000;
            $.supersized(params);
        }

        initFormCSS();

        //菜单状态切换
        initFurniture();
        initHousewares();

        var text_height = $('.con_char').innerHeight();
        if(text_height>200){
	        $("#catagroyContent").css({height: text_height});//$(window).innerHeight()/5
	        $("#catagroyContent").jscroll({
	            W:"15px"
	            ,BgUrl:"url(<?php echo base_url('public/website/images/src01.png') ?>)"
	            ,Bg:"right -30px repeat-y"
	            ,Bar:{Pos:"up"
	                ,Bd:{Out:"-30px 0 repeat-y",Hover:"-30px 0 repeat-y"}
	                ,Bg:{Out:"-15px 0 repeat-y",Hover:"-15px 0 repeat-y",Focus:"-15px 0 repeat-y"}}
	            ,Btn:{btn:true
	                ,uBg:{Out:"0 0",Hover:"0 0",Focus:"0 0"}
	                ,dBg:{Out:"0 -15px",Hover:"0px -16px",Focus:"0 -15px"}}
	            ,Fn:function(){}
	        });
        }
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
            //设置标签a的css
            $('#IDENTITY').removeClass('p2').css('color','#E69A42');
        }
        else if (type=='cate') {
            $("#identity").css({"color":"#000000"});
            $("#product").css({"color":"#F08D39"});
            
            var sort = '<?php
                if ($product_cate) {
                    echo $product_cate->sort;
                }
                ?>';
            //Indoor	Outdoor
			if(sort < 100){
				$("#indoor").css({"color":"#F08D39"});
			}else{
				$("#outdoor").css({"color":"#F08D39"});
			}
			
            var cateid = '<?php
                if ($product_cate) {
                    echo $product_cate->id;
                }
                ?>';
            selProduct(cateid);
            
            //隐藏品牌说明。打开系列说明
//            $('.content').css({"display":"none"});
            $('.content_default').css({"display":"block"});

            //设置标签a的css
            $('#IDENTITY').addClass('p2').hover(function(){
                $(this).css({"color":"#E69A42"});
            });

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
                <dd id="identity" class="yellow"><a id="IDENTITY" class="p2" href="<?php echo site_url('w/product/product_get?brandid='.$product_brand->id.'&type=brand') ?>">IDENTITY</a></dd>
                <dd id="product">PRODUCTS</dd>
                <dd>
                    <ul id="products">
                    	<?php if ($product_brand->id == "10000") : ?>
                    		<li id="indoor">-Indoor</li>
                    		<?php if ($product_cates) : ?>
	                            <?php foreach ($product_cates as $cate) : ?>
	                            	<?php if($cate->sort < 100):?>
	                            		<li id="<?php echo $cate->id ?>">
		                                    <a href="<?php echo site_url('w/product/product_get').'?brandid='.$product_brand->id.'&type=cate&cateid='.$cate->id ?>"><p class="p1">-<?php echo $cate->catecode ?></p></a>
		                                    <a href="<?php echo site_url('w/product/product_get').'?brandid='.$product_brand->id.'&type=cate&cateid='.$cate->id ?>"><p class="p2">-<?php echo $cate->catecodecn ?></p></a>
		                                    <a href="<?php echo site_url('w/product/product_get').'?brandid='.$product_brand->id.'&type=cate&cateid='.$cate->id ?>"><p class="p3">-<?php echo $cate->catecode ?></p></a>
		                                    <a href="<?php echo site_url('w/product/product_get').'?brandid='.$product_brand->id.'&type=cate&cateid='.$cate->id ?>"><p class="p4">-<?php echo $cate->catecodecn ?></p></a>
		                                </li>
	                            	<?php endif;?>
	                            <?php endforeach ?>
	                        <?php endif ?>
	                        
	                        <li id="outdoor">-Outdoor</li>
                    		<?php if ($product_cates) : ?>
	                            <?php foreach ($product_cates as $cate) : ?>
	                            	<?php if($cate->sort > 100):?>
	                            		<li id="<?php echo $cate->id ?>">
		                                    <a href="<?php echo site_url('w/product/product_get').'?brandid='.$product_brand->id.'&type=cate&cateid='.$cate->id ?>"><p class="p1">-<?php echo $cate->catecode ?></p></a>
		                                    <a href="<?php echo site_url('w/product/product_get').'?brandid='.$product_brand->id.'&type=cate&cateid='.$cate->id ?>"><p class="p2">-<?php echo $cate->catecodecn ?></p></a>
		                                    <a href="<?php echo site_url('w/product/product_get').'?brandid='.$product_brand->id.'&type=cate&cateid='.$cate->id ?>"><p class="p3">-<?php echo $cate->catecode ?></p></a>
		                                    <a href="<?php echo site_url('w/product/product_get').'?brandid='.$product_brand->id.'&type=cate&cateid='.$cate->id ?>"><p class="p4">-<?php echo $cate->catecodecn ?></p></a>
		                                </li>
	                            	<?php endif;?>
	                            <?php endforeach ?>
	                        <?php endif ?>
	                        
                    	<?php else :?>
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
	                    <?php endif;?>
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
            <div class="con_default" id="slidecaption"></div>
<!--            <div class="con_default">-->
<!--                --><?php //if ($product_cate) {
//                    echo $product_cate->title;
//                }
//                ?>
<!--            </div>-->
        </div>
        
         <!--Arrow Navigation-->
		<a id="prevslide" class="load-item" style="height:0px;"></a>
		<a id="nextslide" class="load-item" style="height:0px;"></a>
	
        <!--Page Control Bar-->
        <div id="controls-wrapper" class="load-item">
            <!--Navigation-->
            <ul id="slide-list"></ul>
        </div>
    </div>
    <?php $this->load->view("website/common/footer"); ?>
</div>
<script>
	 var ty=1;
	 $(document).ready(function(){
	    $("#supersized,.main").click(function(e){
	        if(ty==0){
	            ty=1;
	        }else{
	           var positionX=e.originalEvent.x-$(this).offset().left||e.originalEvent.layerX-$(this).offset().left||0;//获取当前鼠标相对img的x坐标 
	           var wid=$(window).width()-$(".left_menu").width();
	           if(positionX<=$(this).width()/2){            
	  		     
	  		     $("#prevslide").trigger("click"); 
	  		   }else{
	  			  //$("#nextslide").trigger("click");   
	  			//  alert('as');
	  			$("#nextslide").trigger("click");
	  			
	  		   }
	        }
	    }).css("cursor","pointer");;
	    $(".left_menu").click(function(){
	        ty=0;
	    }).css("cursor","default");;
	    $(".content_default").click(function(){
	    	ty=0;
	    }).css("cursor","default");;
	    $(".content").click(function(){
	    	ty=0;
	    }).css("cursor","default");;
	    $("#controls-wrapper").live('click',function(){
	        ty=0;
	    }).css("cursor","default");;
	    $("#nextslide").click(function(){
	        ty=0;
	    }).css("cursor","default").hide();;
	    $("#prevslide").click(function(){
	        ty=0;
	    }).hide();
	 });
	</script>

</body>
</html>


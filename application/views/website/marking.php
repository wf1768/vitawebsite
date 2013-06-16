<?php $this->load->view("website/common/header"); ?>

<<style>
<!--
.dopage{cursor:pointer  }
-->
</style>
<script
	type="text/javascript"
	src="<?php echo base_url("plugins/supersized/theme/supersized.shutter_marking.js")?>"></script>
<script type="text/javascript">
        jQuery(function($){
        	 //菜单状态切换
            initFurniture();
            initHousewares();
            
			$.supersized({
			
				// Functionality
				autoplay				:	0,
				slide_interval          :   3000,		// Length between transitions
				transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
				transition_speed		:	700,		// Speed of transition
														   
				// Components							
				slide_links				:	'num',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
				slides 					:  	[			// Slideshow Images  image:big_img thumb:small_img

                                                    <?php foreach($list as $key=>$val):?>
                                                    {image : '<?php echo base_url().$val->imagepath;?>', title : '<?php echo $val->content;?>', thumb : '<?php echo base_url().$val->imagepath;?>', url : ''},  
													<?php endforeach;?>
											]
				
			});
			
	    });
	    $(document).ready(function(){
	    	footerCss("showpageinfo23","m1","m2","m3","m4");
			pitchOn("showpageinfo23","h2","m1","m2","m3","m4");
			footerCss("showpageinfo23","h1","h2","h3","h4");
			pitchOn("showpageinfo23","","h1","h2","h3","h4");
			pitchOn('footer','about','f1','f3','f2','f4');
		 });
    </script>

<style type="text/css">
ul#slide-list {
	float: left;
	right: 2%;
	padding: 0px;
	position: absolute;
	margin: 0px;
	left: 68%;
	line-height: 42px;
	overflow: hidden;
	position: absolute;
}

ul#slide-list li {
	float: left;
	list-style: none outside none;
	margin: 0px;
	width: 12px;
	height: 40px;
}

.pic_main {
	height: 98px;
}
</style>
</head>

<body>
<div id="container"><?php $this->load->view("website/common/top"); ?>
<div class="pic_main">
<div class="pic_scroll">
<div id="thumb-tray" class="load-item">
<div id="thumb-back"></div>
<div id="thumb-forward"></div>
</div>
</div>

</div>

<!--内容图片说明-->
<div id="slidecaption" class="pic_con"></div>
<div class="main_bot">
<ul id="showpageinfo23">
	<li > 
	    <a class="h1" href="<?php echo site_url("w/history")?>">
            <img src="<?php echo base_url() ?>public/website/images/footer/lishi2.png">
        </a>
	    <a class="h2"  href="<?php echo site_url("w/history")?>">
	        <img src="<?php echo base_url() ?>public/website/images/footer/lishi3.png">
	    </a>
	    <a class="h3" href="<?php echo site_url("w/history")?>">
	         <img src="<?php echo base_url() ?>public/website/images/footer/lishi.png">
	    </a>
	    <a class="h4" href="<?php echo site_url("w/history")?>">
	      <img src="<?php echo base_url() ?>public/website/images/footer/lishi1.png">
	    </a>
	 </li>
	<li id="h2">
	    <a class="m1" href="">
        <img src="<?php echo base_url() ?>public/website/images/footer/yingji2.png">
     </a>
	    <a class="m2" style="color: #EC934A" href="">
<img src="<?php echo base_url() ?>public/website/images/footer/yingji3.png"></a>
	    <a class="m4" href="">
	         <img src="<?php echo base_url() ?>public/website/images/footer/yingji1.png">
	    </a>
	    <a class="m3" href="">
	         <img src="<?php echo base_url() ?>public/website/images/footer/yingji.png">
	    </a>
	 </li>
</ul>

<ul id="slide-list" style="display: none"></ul>
</div>

													<?php $this->load->view("website/common/footer"); ?></div>
</body>
</html>
<script>
//alert($(window).width()); //浏览器当前窗口可视区域宽度 
</script>
<style>
.news_opactity2 {
	background: url("../../public/website/images/black_mid.png") repeat
		scroll 0 0 transparent;
	height: 98px;
	left: 0;
	position: absolute;
	top: 0;
	width: 156px;
}

#about{
    color: #EC934A;
}
</style>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("website/common/header"); ?>
<link href="<?php echo base_url('public/website/css/news.css') ?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url('plugins/video/css/video-js.css') ?>" type="text/css" rel="stylesheet"/>

<script type="text/javascript" src="<?php echo base_url('public/website/js/news.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('plugins/supersized/theme/supersized.shutter.js') ?>"></script>

<script type="text/javascript" src="<?php echo base_url('plugins/video/js/video.js') ?>"></script>
    
    <script type="text/javascript">
        $(function(){
            //菜单状态切换
            initFurniture();
            initHousewares();
            catagroyContent();
            //footer			
            pitchOn('footer','press','f1','f3','f2','f4');
        });

    </script>
    <script type="text/javascript">
    	//http://www.videojs.com/docs/api/
   		VideoJS.setupAllWhenReady();
   		
	    jQuery(function($){
	    	var slidersArr = new Array();
        	var tmp = <?php echo json_encode($pressList);?>;
			for (var i=0;i<tmp.length;i++) {
      			slidersArr[i] = {image:'../../../public/website/images/transparent.png',title:tmp[i].title,pressid:tmp[i].id,thumb_url:'<?php echo site_url('w/press/press_get').'?pressid='?>'+tmp[i].id,thumb:'<?php echo base_url() ?>'+tmp[i].image};
          	}
			$.supersized({
				// Functionality
				autoplay				:	0,
				slide_interval          :   3000,		// Length between transitions
				transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
				transition_speed		:	700,		// Speed of transition
				// Components							
				slide_links				:	'num',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
				slides 					:  	slidersArr
			});
			//当前焦点新闻
			var pressid = '<?php echo $df_pressid?>';
			$("#"+pressid).removeClass('news_opactity');
			
			//缩略图，鼠标放上显示标题（黑底）
			$('#thumb-list li').hover(function(){
				$el = $(this);
				if ($el.find(".news_opactity").css("display")=="block" && $el.find(".news_black").css("display")=="none"){
					$el.find(".news_opactity").css({"display":"none"});
					$el.find(".news_black").css({"display":"block"});
				}else{
					$el.find(".news_opactity").css({"display":"block"});
					$el.find(".news_black").css({"display":"none"});
				}
			});
			//footer: 
			$('#press').css({"color":"#EC934A"});
	    }); 

    </script>

<!--主内容start-->
<div id="container">
    <?php $this->load->view("website/common/top"); ?>
    <?php if ($type==1) : ?>
	    <div class="bigpic">
	    	<div id="foucs">
	    		<?php if ($press_ImgList) : ?>
	            	<?php foreach ($press_ImgList as $img) : ?>
	                	<div class="element pict" ><img src="<?php echo base_url($img->imagepath) ?>" /></div>
	                <?php endforeach ?>
	            <?php endif ?>
				<div class="element navi left"></div> 
				<div class="element navi right"></div>
			</div>
	    </div>
    <?php endif ?>
    
    <?php if($type==2) : ?>
	    <div class="bigpic">
	    	<!-- Begin VideoJS -->
			  <div class="video-js-box">
			    <video id="press_video" class="video-js"  autoplay="autoplay" loop="loop" controls="controls" preload="auto" poster="../../../public/website/images/video_index.png">
			      <source src="<?php echo base_url($pressVideo->mp4path) ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
<!--			      <source src="--><?php //echo base_url($pressVideo->flvpath) ?><!--" type='video/ogg; codecs="theora, vorbis"' />-->
                  <source src="<?php echo base_url($pressVideo->flvpath) ?>" type='video/webm; codecs="vp8, vorbis"' />
			      <!-- 如果浏览器不兼容HTML5则使用flash播放 -->
			      <object id="press_flash" class="vjs-flash-fallback" type="application/x-shockwave-flash" data="">
			        <param name="movie" value="<?php echo base_url('plugins/video/css/flowplayer.commercial.swf') ?>" />
			        <param name="allowfullscreen" value="true" />
			        <param name="bgColor" value="#030303" />
			        <param name="flashvars" value='config={"playlist":["../../../public/website/images/video_index.png", {"url": "<?php echo base_url($pressVideo->mp4path) ?>","autoPlay":false,"autoBuffering":true,"scaling":"orig"}]}' />
			        <!-- 视频图片. -->
			        <img src="" width="640" height="264" alt="Poster Image"
			          title="No video playback capabilities." />
			      </object>
			    </video>
			  </div>
			  <!-- End VideoJS -->
	    </div>
    <?php endif ?>
    
    <!--原为title现在由于存放新闻的ID-->
	<div id="slidecaption" class="pic_con" style="display: none;"></div>
    <div class="cons">
    	<div class="con_box">
         <div class="conle"><div class="conle_title"><?php echo $pressObj->title ?></div></div>
         <div class="conri">
         	<div id="news_cont" class="time_charle" style="top:0px; position:relative;">
                    <?php echo $pressObj->content ?>
            </div>
         </div>
        </div>
    </div>
    
    <div class="pic_mains">
        <div class="pic_scroll">
           <div id="thumb-tray" class="load-item">
				<div id="thumb-back"></div>
				<div id="thumb-forward"></div>
			</div>
        </div>
    </div>
    
    <?php $this->load->view("website/common/footer"); ?>
</div>
</body>
</html>


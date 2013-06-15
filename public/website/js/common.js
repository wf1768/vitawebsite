
	$(function(){
		//footer menu
		//$(".main_footer ul li a").click(function(){
			//$(this).css("color","#EC934A");
		//});
		//Stores - main_bot
		$(".main_bot ul li a").click(function(){
			$.each($(".main_bot ul li a"),function(index,liItem){
				$(liItem).removeClass("cur");
			});
			$(this).addClass("cur");
		});
	});


	var params ={
	
		// Functionality
		slideshow               :   1,			// Slideshow on/off
		autoplay				:	1,			// Slideshow starts playing automatically
		start_slide             :   1,			// Start slide (0 is random)
		stop_loop				:	0,			// Pauses slideshow on last slide
		random					: 	1,			// Randomize slide order (Ignores start slide)
		slide_interval          :   5000,		// Length between transitions
		transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
		transition_speed		:	2500,		// Speed of transition
		new_window				:	1,			// Image links open in new window/tab
		pause_hover             :   0,			// Pause slideshow on hover
		keyboard_nav            :   0,			// Keyboard navigation on/off
		performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
		image_protect			:	1,			// Disables image dragging and right click with Javascript
												   
		// Size & Position						   
		min_width		        :   0,			// Min width allowed (in pixels)
		min_height		        :   0,			// Min height allowed (in pixels)
		vertical_center         :   0,			// Vertically center background
		horizontal_center       :   1,			// Horizontally center background
		fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
		fit_portrait         	:   0,			// Portrait images will not exceed browser height
		fit_landscape			:   0,			// Landscape images will not exceed browser width
												   
		// Components							
		slide_links				:	'num',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
		thumb_links				:	0,			// Individual thumb links for each slide
		thumbnail_navigation    :   0,			// Thumbnail navigation
		slides 					:  	[],
									
		// Theme Options			   
		progress_bar			:	0,			// Timer for each slide							
		mouse_scrub				:	0
	}
	
	//加载菜单
	//menuType 0页面右上角菜单 1 页面右下角菜单
	function LoadMenu(menus,menuTypes)
	{
		var menuStr = "<ul >";
		if (menus!=undefined)
		{
			if (menus.id==undefined)
			{
				$.each(menus,function(index,menuItem){
					var menuId = menuItem.id;
					var menucnSrc =menuItem.cnSrc;
					var menuenSrc =menuItem.enSrc;
					var linkUrl = menuItem.linkUrl==""?"#":menuItem.linkUrl;
					menuStr =menuStr + '<li><a href="'+linkUrl+'" ><img src="'+menuenSrc+'" alt="" border="0px;" id="'+ menuId +'"  onClick="SetCookie(\'Nowpage\',0)"/></a></li>';
					if (index!= menus.length-1)
					{
						menuStr =menuStr + '<li><img src="Images/menu/split.png" alt="" class="split-line"/></li>'
					}
				});
			}
			else
			{
					menuStr =menuStr + '<li><a href="'+(menus.linkUrl==""?"#":menus.linkUrl)+'"><img src="'+menus.enSrc+'" alt="" border="0px;" id="'+ menus.id +'" /></a></li>';
			}
		}
		menuStr = menuStr + '</ul>';
		switch(menuTypes)
		{
			case 0:
				menuTopItems = menus;
				$('#menu').html(menuStr);
				break;
			case 1:
				menuBotItems = menus;
				$('#bottommenu').html(menuStr);
				$('#bottommenu li a').attr('target', '_blank');  
				break;
		}

	}
	

	/**
	 * 头部品牌菜单
	 * */
	function initFurniture(){
		//类别
		$("#furniture").find(".n1").css("display","block");
		$("#furniture").find(".n2").css("display","none");
		
		$.each($("#furniture_menu li"),function(index,liItem){
			$(liItem).find(".n1").css("display","block");
			$(liItem).find(".n2").css("display","none");
		});
		//移动到产品分类菜单条上
		$("#furniture_menu li a").hover(function() {
			$el = $(this);
			if ($el.find(".n1").css("display")=="block" && $el.find(".n2").css("display")=="none"){
				$el.find(".n1").css({"display":"none"});
				$el.find(".n2").css({"display":"block"});
			}else{
				$el.find(".n1").css({"display":"block"});
				$el.find(".n2").css({"display":"none"});
			}
		});
		
		$("#furniture_menu li a").click(function(e) {
			src = $(this).find('img').attr("src");
			// 当前品牌d log
			$("#currentBrand").attr("src",src);
			pid = $(this).attr('id');
			selFurniture(pid);
		});
	}
	
	/**
	 * 选择某个品牌
	 * */
	function selFurniture(pid){
		//类别
		$("#furniture").find(".n1").css("display","block");
		$("#furniture").find(".n2").css("display","none");
		
		$("#housewares").find(".n1").css("display","block");
		$("#housewares").find(".n2").css("display","none");
		
		$.each($("#housewares_menu li a"),function(index,liItem){
			$(liItem).find(".n1").css("display","block");
			$(liItem).find(".n2").css("display","none");
		});
		$.each($("#furniture_menu li a"),function(index,liItem){
			$(liItem).find(".n1").css("display","block");
			$(liItem).find(".n2").css("display","none");
		});
		// 显示内容 后台读取
		//。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。
		//。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。
		
	}
	
	function initHousewares(){
		//类别
		$("#housewares").find(".n1").css("display","block");
		$("#housewares").find(".n2").css("display","none");
		
		$.each($("#housewares_menu li"),function(index,liItem){
			$(liItem).find(".n1").css("display","block");
			$(liItem).find(".n2").css("display","none");
		});
		//移动到产品分类菜单条上
		$("#housewares_menu li a").hover(function() {
			$el = $(this);
			if ($el.find(".n1").css("display")=="block" && $el.find(".n2").css("display")=="none"){
				$el.find(".n1").css({"display":"none"});
				$el.find(".n2").css({"display":"block"});
			}else{
				$el.find(".n1").css({"display":"block"});
				$el.find(".n2").css({"display":"none"});
			}
		});
		
		$("#housewares_menu li a").click(function(e) {
			src = $(this).find('img').attr("src");
			$("#currentBrand").attr("src",src);
			pid = $(this).attr('id');
			selHousewares(pid);
		});
	}
	
	/**
	 * 选择某个品牌
	 * */
	function selHousewares(pid){
		//类别
		$("#furniture").find(".n1").css("display","none");
		$("#furniture").find(".n2").css("display","block");
		
		$("#housewares").find(".n1").css("display","block");
		$("#housewares").find(".n2").css("display","none");
		
		$.each($("#furniture_menu li a"),function(index,liItem){
			$(liItem).find(".n1").css("display","block");
			$(liItem).find(".n2").css("display","none");
		});
		$.each($("#housewares_menu li a"),function(index,liItem){
			$(liItem).find(".n1").css("display","block");
			$(liItem).find(".n2").css("display","none");
		});
		// 显示内容 后台读取
		//。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。
		//。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。
		
	}
	
	/**
	 * footer
	 * @param ulId ul标签ID，
	 * @param c1,c3,c2,c4
	 * */
	function footerCss(ulId,c1,c3,c2,c4){
		//初始状态
		$.each($("#"+ulId+" li"),function(index,liItem){
			$(liItem).find("."+c1).css("display","block");
			$(liItem).find("."+c3).css("display","none");
			$(liItem).find("."+c2).css("display","none");
			$(liItem).find("."+c4).css("display","none");
		});
		//移动到菜单条上
		$("#"+ulId+" li").hover(function() {
			$el = $(this);
			if ($el.find("."+c1).css("display")=="none" && $el.find("."+c2).css("display")=="none"){
				$el.find("."+c3).css({"display":"none"});
				$el.find("."+c4).css({"display":"block"});
			}else{
				$el.find("."+c1).css({"display":"none"});
				$el.find("."+c2).css({"display":"block"});
			}
		}, function() {
			$el = $(this);
			if ($el.find("."+c1).css("display")=="none" && $el.find("."+c2).css("display")=="none"){
				$el.find("."+c3).css({"display":"block"});
				$el.find("."+c4).css({"display":"none"});
			}else{
				$el.find("."+c1).css({"display":"block"});
				$el.find("."+c2).css({"display":"none"});
			}
		});
	}
	
	/**
	 * 在当前页初始调用此方法
	 * @param ulId ul标签ID
	 * @param fid 当前选中ID
	 * */
	function pitchOn(ulId,fid,c1,c3,c2,c4){
		if (fid!="" && fid!=null){
			var slidersArr = new Array();
			//还原所有菜单项
			$.each($("#"+ulId+" li"),function(index,liItem){
				$(liItem).find("."+c1).css("display","block");
				$(liItem).find("."+c3).css("display","none");
				$(liItem).find("."+c2).css("display","none");
				$(liItem).find("."+c4).css("display","none");
				if ($(liItem).attr('id')==fid){
					$(liItem).find("."+c1).css("display","none");
					$(liItem).find("."+c3).css("display","block");
					$(liItem).find("."+c2).css("display","none");
					$(liItem).find("."+c4).css("display","none");
				}
			});
		}
	}
	
	$(function(){
		footerCss("footer","f1","f3","f2","f4")
	});

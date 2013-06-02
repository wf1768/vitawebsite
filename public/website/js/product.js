
    //分类品牌产品内容
	function catagroyContent(){
//           $("#catagroyContent").html('<p class="cha">在床的设计制造领域中，Flou公司一直占据了翘楚地位。Flou 在意大利已经有五十多年的历史，自1978年开始，工厂聘请了著名的设计师VicoMagistretti设计了Flou的第一款床Nathalie，藉此Flou渐渐成为了一家专著于床具的公司，并且不断推陈出新，成为闻名欧洲乃至世界的经典顶级床具公司。它追求自然环保、讲究完美质量和使用寿命，其中Nathalie系列更是被称为床具中的经典。</p>'+
//                '<p class="eng">Luxuriant The price oLuxuriant The price of Reda is from 3338.00 RMB to 4348.00 RMB. Hardware and Exceed fees are not included.Hardware and Exceed fees are not included.Luxuriant The price of Reda is from 3338.00 RMB to 4348.00 RMB.Hardware and Exceed fees are not included.Luxuriant The price of Reda is from 3338.00 RMB to 4348.00 RMB. </p>');

//		$("#catagroyContent").css({height: $(window).innerHeight()/5});
//		$("#catagroyContent").jscroll({
//			   W:"15px"
//			  ,BgUrl:"url(/vita/public/website/images/src01.png)"    //TODO 这里上线时要修改地址。服务器上的目录不一样
//			  ,Bg:"right -30px repeat-y"
//			  ,Bar:{Pos:"up"
//					,Bd:{Out:"-30px 0 repeat-y",Hover:"-30px 0 repeat-y"}
//					,Bg:{Out:"-15px 0 repeat-y",Hover:"-15px 0 repeat-y",Focus:"-15px 0 repeat-y"}}
//					,Btn:{btn:true
//						  ,uBg:{Out:"0 0",Hover:"0 0",Focus:"0 0"}
//						  ,dBg:{Out:"0 -15px",Hover:"0px -16px",Focus:"0 -15px"}}
//			  ,Fn:function(){}
//		});
		
		$('.content_none').css({"display":"none"});
		$('.zooms').click(function(){
			$('.content').animate({height: 'toggle'},function(){
			  $('.content').css({"display":"none"});
		  	});
			$('.content_none').animate({height: 'toggle'},function(){
				$('.content_none').css({"display":"block"});
		  	});
		});
		
		$('.content_none').click(function(){
			$('.content').animate({height: 'toggle'},function(){
			  $('.content').css({"display":"block"});
		  	});
			$('.content_none').animate({height: 'toggle'},function(){
				$('.content_none').css({"display":"none"});
		  	});
		});
	}
	
	function productsInfo(){
		//初始状态
		$.each($("#products li"),function(index,liItem){
			$(liItem).find(".p1").css("display","block");
			$(liItem).find(".p3").css("display","none");
			$(liItem).find(".p2").css("display","none");
			$(liItem).find(".p4").css("display","none");
		});
		//移动到菜单条上
		$("#products li").hover(function() {
			$el = $(this);
			if ($el.find(".p1").css("display")=="none" && $el.find(".p2").css("display")=="none"){
				$el.find(".p3").css({"display":"none"});
				$el.find(".p4").css({"display":"block"});
			}else{
				$el.find(".p1").css({"display":"none"});
				$el.find(".p2").css({"display":"block"});
			}
		}, function() {
			$el = $(this);
			if ($el.find(".p1").css("display")=="none" && $el.find(".p2").css("display")=="none"){
				$el.find(".p3").css({"display":"block"});
				$el.find(".p4").css({"display":"none"});
			}else{
				$el.find(".p1").css({"display":"block"});
				$el.find(".p2").css({"display":"none"});
			}
		});
		var isClick = 0; //标识是否已经点击过
		$("#products li").click(function(e) {
//			$("#identity").css({"color":"#000000"});
//			$("#product").css({"color":"#F08D39"});
//			pid = $(this).attr('id');
//			selProduct(pid);
			//
//			if(isClick==0){
//				var status = $('.content_none').css("display");
//				if(status=="none"){
//					$('.content').animate({height: 'toggle'},function(){
//						  $('.content').css({"display":"none"});
//				  	});
//				}else{
//					$('.content_none').animate({height: 'toggle'},function(){
//						  $('.content_none').css({"display":"none"});
//				  	});
//				}
//				$('.content_default').css({"display":"block"});//这里还需传值
//				isClick = 1;
//			}
			
			
			
		});
	}
	
	function selProduct(pid){
		if (pid!="" && pid!=null){
			vars.is_paused = 0;
			var slidersArr = new Array();
			//还原所有菜单项
			$.each($("#products li"),function(index,liItem){
				$(liItem).find(".p1").css("display","block");
				$(liItem).find(".p3").css("display","none");
				$(liItem).find(".p2").css("display","none");
				$(liItem).find(".p4").css("display","none");
				if ($(liItem).attr('id')==pid){
					isSelected = 1;
					$(liItem).find(".p1").css("display","none");
					$(liItem).find(".p3").css("display","block");
					$(liItem).find(".p2").css("display","none");
					$(liItem).find(".p4").css("display","none");
				}
			});
		}
	}

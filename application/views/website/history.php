<?php $this->load->view("website/common/header"); ?>
<script type="text/javascript">
        $(function(){
            var slidersArr = new Array();
            var tmp = <?php echo $indeximg;?>;
            for (var i=0;i<tmp.length;i++) {
                slidersArr[i] = {'image':'<?php echo base_url() ?>' + tmp[i].imagepath};
            }
            params.slides = slidersArr;
            $.supersized(params);

            //菜单状态切换
              initFurniture();
              initHousewares();
              
            var content = '<ul>'+
            <?php foreach($history as $key=>$val):?>
               <?php if(isset($_GET['id'])):?>
                  '<li><a href="<?php echo site_url("w/history?id=").$val->id;?>" <?php if($val->id==trim($_GET['id'])) echo 'class="cur"';?>><?php echo $val->year;?></a></li>'+
               <?php else:?>
                  '<li><a href="<?php echo site_url("w/history?id=").$val->id;?>" <?php if($key==0) echo 'class="cur"';?>><?php echo $val->year;?></a></li>'+
              <?php endif;?>
              <?php endforeach;?>
        	'</ul>';
			$("#content").html(content);
			$("#content").css({height: $(window).innerHeight()/5});
			$("#content").jscroll({
				   W:"15px"
				  ,BgUrl:"url(<?php echo base_url() ?>public/website/images/src01.png)"
				  ,Bg:"right -30px repeat-y"
				  ,Bar:{Pos:"up"
						,Bd:{Out:"-30px 0 repeat-y",Hover:"-30px 0 repeat-y"}
						,Bg:{Out:"-15px 0 repeat-y",Hover:"-15px 0 repeat-y",Focus:"-15px 0 repeat-y"}}
						,Btn:{btn:true
							  ,uBg:{Out:"0 0",Hover:"0 0",Focus:"0 0"}
							  ,dBg:{Out:"0 -15px",Hover:"0px -16px",Focus:"0 -15px"}}
				  ,Fn:function(){}
			});
			
			$('#content ul li a').click(function(){
				
//				$.each($("#content ul li a"),function(index,liItem){
//					$(liItem).attr("class","");
//				});
//				$(this).attr("class","cur");
//				//改
//				 tmp=$(this).attr("_img");
//				 for (var i=0;i<tmp.length;i++) {
//                   slidersArr[i] = {'image':'<?php echo base_url() ?>' + tmp[i].imagepath};
//                 }
//				setHistoryContent($("#"+$(this).attr("_val")).html());
			});

			//空白处
			//var margin_height = $(window).height();
			//margin_height = margin_height-(42+33+200);
			//$("#margin").css({"height":margin_height});
			
			//历史鼠标事件-
			
			$("#margin").hover(function(){
				$('.time_main').animate({height: '0px'},function(){
					$('.time_main').css({"display":"none"});
					$('.time_mainone').animate({height: '40px'});
					$('.time_mainone').css({"display":"block"});
				});
				
			});
			
			$(".time_mainone").hover(function(){
				$('.time_mainone').animate({height: '0px'},function(){
					$('.time_mainone').css({"display":"none"});
					$('.time_main').animate({height: '150px'});
					$('.time_main').css({"display":"block"});
				});
			});
			
        });
		//历史内容
		function setHistoryContent(cha,eng){
			$('#history_cha').html(cha);
			$('#history_eng').html(eng);
		}
    </script>
<div id="container"><?php $this->load->view("website/common/top"); ?> <?php foreach($history as $key=>$val):?>
<div style="display: none" id="c<?php echo $val->year?>"><?php echo $val->content?></div>
            <?php endforeach;?>

<div id="margin" style="width: 100%;height:80px;background-image:url('<?php echo base_url() ?>public/website/images/transparent.png'); position:absolute;bottom: 230px;">&nbsp;</div>

<div class="time_main">
<div class="time_mainle">
<div id="mainBox" class="time_char">
<div id="content" class="time_charle"
	style="top: 0px; position: relative;"></div>
<div class="scroll_line"
	style="top: 0px; right: 0px; position: absolute; overflow: hidden;"></div>
</div>
</div>

<div class="time_mainri">
<?php echo $showinfo->content;?>
</div>
</div>
<!-- 收缩 start -->
<div class="time_mainone">
<div class="time_mainle">
<div class="time_char">
<div class="time_charle" style="top: 0px; position: relative;color:#EC934A;  font-family: Arial,Helvetica,sans-serif;
    font-size: 18px;
    font-weight: bold;
    padding: 2px 0; margin-top:-4px"><?php echo $showinfo->year;?></div>
<div class="scroll_line"
	style="top: 0px; right: 0px; position: absolute; overflow: hidden;"></div>
</div>
</div>
<div class="time_mainri">
<?php echo $showinfo->content;?>
<p class="eng"></p>
</div>
</div>
<!-- 收缩 end -->

<div class="main_bot">
<ul>
	<li><a href="#" style="color: #EC934A">History</a></li>
	<li><a href="<?php echo site_url("w/marking")?>">Marking</a></li>
</ul>
</div>
            <?php $this->load->view("website/common/footer"); ?>
 </div>

</body>
</html>


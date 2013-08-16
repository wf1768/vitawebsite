<?php $this->load->view("website/common/header"); ?>  
    <script type="text/javascript">
        $(function(){
        	//菜单状态切换
            initFurniture();
            initHousewares();
            
            var slidersArr = new Array();
            
            var tmp = <?php echo $indeximg;?>;
            for (var i=0;i<tmp.length;i++) {
                slidersArr[i] = {'image':'<?php echo base_url() ?>' + tmp[i].imagepath};
            }

            params.slides = slidersArr;
            $.supersized(params);
            
         	// Accordion
          	//先隐藏所有Item
//			$(".item").hide();
//			//显示第一个Item
//			$(".item:first").show();
//			$("#accordion h2").click(function () {
//				//如果当前Item是隐藏
//				if ($(this).next().is(":hidden")) {
//					//先slideUp所有Item
//					$(".item").slideUp(1000);
//					//slideDown当前Item
//					$(this).next().slideDown(1000);
//				}
//			});
            footerCss("mystore","m1","m2","m3","m4");
			pitchOn("mystore","m2","m1","m2","m3","m4");
			footerCss("mystore","h1","h2","h3","h4");
			pitchOn("mystore","h2","h1","h2","h3","h4");
			pitchOn('footer','store','f1','f3','f2','f4');
        });

    </script>
<!--主内容start-->
<div id="container">
    <?php $this->load->view("website/common/top"); ?>
    <div class="leftmain">
        <div style="bottom: 0px;position: absolute; width:285px;">
        	<div id="accordion">
        	 <?php foreach($storelist as $key=>$val):?>
        	  <?php if(isset($_GET['id'])):?>
        	  	<div class="">
        	  	    <?php if($_GET['id'] != $val->id):?>
		         	<h2><a href="<?php echo site_url('w/store?id=').$val->id."&typeid=".$typeid;;?>"><?php echo $val->title;?></a></h2>
		         	<?php endif;?>
		         	<dl class="item" style="display:<?php if($val->id==trim($_GET['id'])) echo 'block;' ; else echo  'none';?> ">
		                <!--<?php if($_GET['id'] == $val->id):?>
		         	           <?php echo $val->title;?> 
		         	    <?php endif;?>
		                --><?php echo $val->content;?>
					</dl>
		       	</div>
        	  <?php else:?>
		       	<div class="">
		         	<?php if($key !=0):?><h2><a href="<?php echo site_url('w/store?id=').$val->id."&typeid=".$typeid;;?>"><?php echo $val->title;?></a></h2><?php endif;?>
		         	<dl class="item" style="display:<?php if($key==0) echo 'block;' ; else echo 'none';?> ">
<!--		               <?php if($key ==0)echo $val->title;?>-->
		                <?php echo $val->content;?>
					</dl>
		       	</div>
		       	
		       	<?php endif;?>
		       	
		       	<?php endforeach;?>
		       	
			</div>
        </div>
    </div>
    
    <div class="main_bot">
    	<div align="center">
        <ul id="mystore"><!--
<!--            <?php foreach($class as $key=>$val):?>-->
<!--               <li>-->
<!--                 <a <?php if($val->id==$typeid) echo 'class="cur"'?> href="<?php echo site_url('w/store?typeid=').$val->id?>"><?php echo $val->storescode?> </a></li>-->
<!--            <?php endforeach;?>-->

             
             
             
             
             
        <li <?php if($typeid==$class[0]->id) echo 'id="h2"'?>>
            <a id="nohovers"  class="h3" href="<?php echo site_url('w/store?typeid=').$class[0]->id ?>">丰意德分店</a>
            <a id="onhovers"  class="h4 " href="<?php echo site_url('w/store?typeid=').$class[0]->id ?>">丰意德分店</a>
            <a  id="nohovers" class="h1" href="<?php echo site_url('w/store?typeid=').$class[0]->id ?>">Furniture Stores</a>
            <a  id="onhovers" class="h2 " href="<?php echo site_url('w/store?typeid=').$class[0]->id ?>">Furniture Stores</a>
        </li>
        <?php if($open->value==1):?>
        <li  <?php if($typeid==$class[1]->id) echo 'id="m2"'?>>
                <a  id="nohovers" class="m3"  href="<?php echo site_url('w/store?typeid=').$class[1]->id ?>">饰品分店</a>
                <a  id="onhovers" class="m4 cur"  href="<?php echo site_url('w/store?typeid=').$class[1]->id ?>">饰品分店</a>
                <a  id="nohovers" class="m1" style="color:#FFFFFF"  href="<?php echo site_url('w/store?typeid=').$class[1]->id ?>">Housewares Stores</a>
                <a  id="onhovers" class="m2 cur"  href="<?php echo site_url('w/store?typeid=').$class[1]->id ?>">Housewares Stores</a>
        </li>
        <?php endif;?>
        </ul>
        </div>
         
    </div>
    <!--Page Control Bar-->
    <div id="controls-wrapper" class="load-item">
    	<!--Navigation-->
        <ul id="slide-list"></ul>
    </div>
    <?php $this->load->view("website/common/footer"); ?>
</div>
</body>
</html>
<style>
#store{
    color: #EC934A;
}
#controls-wrapper {width: 37%;background: none;}
#onhovers{color: #EC934A;display:block;width:110px; font-family:"微软雅黑";}
#nohovers{color: #FFFFFF;display:block;width:130px; font-family:"微软雅黑";}
</style>


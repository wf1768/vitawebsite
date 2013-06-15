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
		                <?php if($_GET['id'] == $val->id):?>
		         	           <?php echo $val->title;?> 
		         	    <?php endif;?>
		                <?php echo $val->content;?>
					</dl>
		       	</div>
        	  <?php else:?>
		       	<div class="">
		         	<h2><a href="<?php echo site_url('w/store?id=').$val->id."&typeid=".$typeid;;?>"><?php echo $val->title;?></a></h2>
		         	<dl class="item" style="display:<?php if($key==0) echo 'block;' ; else echo 'none';?> ">
		                <?php echo $val->content;?>
					</dl>
		       	</div>
		       	
		       	<?php endif;?>
		       	
		       	<?php endforeach;?>
		       	
			</div>
        </div>
    </div>
    
    <div class="main_bot">
        <ul>
            <?php foreach($class as $key=>$val):?>
               <li><a <?php if($val->id==$typeid) echo 'class="cur"'?> href="<?php echo site_url('w/store?typeid=').$val->id?>"><?php echo $val->storescode?></a></li>
            <?php endforeach;?>
            
            
        </ul>
    </div>
    <?php $this->load->view("website/common/footer"); ?>
</div>
</body>
</html>
<style>
#store{
    color: #EC934A;
}
</style>


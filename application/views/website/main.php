<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view("website/common/header"); ?>

    <script type="text/javascript">
        $(function(){
            var slidersArr = new Array();
            <!-- 注意，这种将php数组转为javascript数组，可能有中文问题。-->
            var tmp = <?php echo json_encode($main);?>;

            for (var i=0;i<tmp.length;i++) {
                slidersArr[i] = {'image':'<?php echo base_url() ?>' + tmp[i].imagepath};
            }

            if (slidersArr.length > 0) {
                params.slides = slidersArr;
                $.supersized(params);
            }

            //菜单状态切换
            initFurniture();
            initHousewares();
            catagroyContent();
        });

    </script>

<!--主内容start-->
<div id="container">
    <?php $this->load->view("website/common/top"); ?>
    <?php $this->load->view("website/common/footer"); ?>
</div>
</body>
</html>


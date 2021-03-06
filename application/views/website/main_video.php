<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <META name="Description" content=" 成立于1998年的北京丰意德家具有限责任公司是目前国内代理国外顶级家居品牌最多、国际家居流行趋势更新最快,展厅规模最大的一家进口家具代理销售机构。 丰意德代理经营诸多...">
    <META name=Keywords content="丰意德,意大利,进口家具,家具">
    <title><?php echo $sys_title ?></title>
    <link href="<?php echo base_url('public/website/css/index.css') ?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url('public/website/css/base.css') ?>" type="text/css" rel="stylesheet"/>

    <link rel="stylesheet" href="<?php echo base_url('plugins/bigvideo/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/bigvideo/css/bigvideo.css') ?>">

    <script type="text/javascript" src="<?php echo base_url('public/js/jquery-1.7.2.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/website/js/common.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/website/js/jscroll.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/website/js/product.js') ?>"></script>

    <script src="<?php echo base_url('plugins/bigvideo/js/jquery-ui-1.8.22.custom.min.js') ?>"></script>
    <script src="<?php echo base_url('plugins/bigvideo/js/modernizr-2.5.3.min.js') ?>"></script>
    <script src="<?php echo base_url('plugins/bigvideo/js/jquery.imagesloaded.min.js') ?>"></script>
    <script src="<?php echo base_url('plugins/bigvideo/js/video.js') ?>"></script>
    <!-- BigVideo -->
    <script src="<?php echo base_url('plugins/bigvideo/js/bigvideo.js') ?>"></script>

    <style>
        video {
            width: 100% !important;
            height: 100% !important;
        }
    </style>
</head>
<body>

    <script type="text/javascript">
        $(function(){
            var BV = new $.BigVideo({useFlashForFirefox:false,forceAutoplay:true});

            //菜单状态切换
            initFurniture();
            initHousewares();
            catagroyContent();

            BV.init();

            if (Modernizr.touch) {
                BV.show('<?php echo base_url('upload/main/clip.png') ?>');
<!--                BV.show('--><?php //echo base_url('upload/main/clip.mp4') ?><!--', {altSource:'--><?php //echo base_url('upload/main/clip.webm') ?><!--',doLoop:true});-->
                BV.show('<?php echo base_url('upload/main/clip.mp4') ?>');
            } else {
                BV.show('<?php echo base_url('upload/main/clip.mp4') ?>', {altSource:'<?php echo base_url('upload/main/clip.webm') ?>',doLoop:true});
<!--                BV.show('--><?php //echo base_url('upload/main/clip.mp4') ?><!--');-->
            }


            $('#big-video-wrap').on('touchstart',function(e){
//                alert('adf');
//                $('#big-video-image').css({'display':'none'});
//                $('#big-video-vid').css({'display':'block'});
                e.preventDefault();
                BV.getPlayer().play();
            });

            //循环播放，多浏览器支持.
//            $('#big-video-vid_html5_api').bind("ended",function() {
//                this.play();
//            })
//            $('#big-video-control-play').hide();
//            $('#big-video-control-timer').hide();
//            $('#big-video-control-middle').hide();
//            $('#big-video-control-container').hide();
//            $('#big-video-control-container').css({'display':'none'});
        });



    </script>

<!--主内容start-->
<div id="container">
    <?php $this->load->view("website/common/top"); ?>
    <?php $this->load->view("website/common/footer"); ?>
</div>
</body>
</html>


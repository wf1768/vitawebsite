<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <META name="Description" content=" 成立于1998年的北京丰意德家具有限责任公司是目前国内代理国外顶级家居品牌最多、国际家居流行趋势更新最快,展厅规模最大的一家进口家具代理销售机构。 丰意德代理经营诸多...">
    <META name=Keywords content="丰意德,意大利,进口家具,家具">
    <title><?php echo $sys_title ?></title>
    <link href="<?php echo base_url('public/website/css/index.css') ?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url('public/website/css/base.css') ?>" type="text/css" rel="stylesheet"/>
<!--    <script type="text/javascript" src="--><?php //echo base_url('public/js/jquery-1.7.2.min.js') ?><!--"></script>-->

    <link rel="stylesheet" href="<?php echo base_url('plugins/supersized/css/supersized.css') ?>" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url('plugins/supersized/theme/supersized.shutter.css') ?>" type="text/css" media="screen" />

    <script type="text/javascript" src="<?php echo base_url('public/js/jquery-1.7.2.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('plugins/supersized/js/jquery.easing.min.js') ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('plugins/supersized/js/supersized.3.2.7.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('plugins/supersized/theme/supersized.shutter.js') ?>"></script>

    <script type="text/javascript" src="<?php echo base_url('public/website/js/common.js') ?>"></script>

    <style>
        body {
            background-color: #D0D0C5;
            font-size: 12px;
            min-height: 630px;
            min-width: 1020px;
            overflow: hidden;
<!--            background-image: url("--><?php //echo $index->infopath ?><!--");-->
        }
        * {
            margin: 0;
            padding: 0;
        }
    </style>

    <script type="text/javascript">
        $(function(){
            var slidersArr = new Array();
            <!-- 注意，这种将php数组转为javascript数组，可能有中文问题。-->
<!--            var tmp = --><?php //echo json_encode($main);?><!--;-->
<!---->
<!--            for (var i=0;i<tmp.length;i++) {-->
<!--                slidersArr[i] = {'image':'--><?php //echo base_url() ?><!--' + tmp[i].imagepath};-->
<!--            }-->
            slidersArr[0] = {'image':'<?php echo base_url().$index->infopath ?>'};

            if (slidersArr.length > 0) {
                params.slides = slidersArr;
                params.autoplay = 0;
                $.supersized(params);
            }
        });

    </script>

</head>
<body ><!--style="background:#fff;"-->
<img src="<?php echo $index->infopath ?>" width="100%" height="100%" style="z-index:-1" />
<div class="index_main">
    <a href="<?php echo site_url('w/main') ?>"><img src="<?php echo $index->logopath ?>" width="1200" height="400" /></a>

</div>
<div class="index_bot">
    <span>本网站是兼容所有现代浏览器与微软IE浏览器的最新版本8和9</span>
    <strong>THIS SITE IS COMPATIBLE WITH ALL MODERN BROWSERS AND THE LATEST VERSIONS OF MICROSOFT IE 9 and 8 </strong>
</div>

</body>
</html>
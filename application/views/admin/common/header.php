<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $sys_title ?></title>

    <!-- bootstrap -->
    <link href="<?php echo base_url('public/admin/css/bootstrap/bootstrap.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/admin/css/bootstrap/bootstrap-responsive.css') ?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/admin/css/bootstrap/bootstrap-overrides.css') ?>" type="text/css" rel="stylesheet" />

    <!-- libraries -->
<!--    <link href="--><?php //echo base_url('public/admin/css/lib/jquery-ui-1.10.2.custom.css') ?><!--" rel="stylesheet" type="text/css" />-->
    <link href="<?php echo base_url('public/admin/css/lib/font-awesome.css') ?>" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url('public/admin/css/compiled/form-showcase.css') ?>" type="text/css" media="screen" />

    <!-- global styles -->  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/css/compiled/layout.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/css/elements.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/css/icons.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/css/icons.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/css/new-user.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/css/datepicker.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/admin/css/compiled/gallery.css') ?>" type="text/css" media="screen" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="<?php echo base_url('public/admin/css/compiled/index.css ') ?>" type="text/css" media="screen" />

    <!-- open sans font -->
<!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>-->

    <!-- lato font -->
<!--    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>-->

    <!--[if lt IE 9]>
    <script src="<?php echo base_url('public/js/html5.js') ?>"></script>
    <![endif]-->

    <!-- scripts -->  
    <script src="<?php echo base_url('public/js/jquery-1.7.2.min.js') ?>"></script>
    <script src="<?php echo base_url('public/js/json2.js') ?>"></script>
    <script src="<?php echo base_url('public/js/us.stock.js') ?>"></script>
    <script src="<?php echo base_url('public/admin/js/bootstrap.min.js') ?>"></script>
<!--    <script src="--><?php //echo base_url('public/admin/js/jquery-ui-1.10.2.custom.min.js') ?><!--"></script>-->
    <script src="<?php echo base_url('public/admin/js/theme.js') ?>"></script>
    <script src="<?php echo base_url('public/admin/js/bootbox.min.js') ?>"></script>


    <script type="text/javascript" src="<?php echo base_url('plugins/plupload/js/plupload.full.js') ?>"></script>
<!--    <script type="text/javascript" src="--><?php //echo base_url('plugins/plupload/js/i18n/zh-cn.js') ?><!--"></script>-->

    <link type="text/css" href="<?php echo base_url('plugins/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css') ?>" rel="stylesheet">

    <script type="text/javascript" src="<?php echo base_url('plugins/plupload/js/plupload.full.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('plugins/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('plugins/plupload/js/i18n/zh-cn.js') ?>"></script>
    <script src="<?php echo base_url('public/admin/js/bootstrap-datepicker.js') ?>"></script>
     <script src="<?php echo base_url('public/admin/js/ckeditor.js') ?>"></script>
</head>
<body>

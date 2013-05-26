<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!-- sidebar -->
<div id="sidebar-nav" class="hidden-phone">
    <ul id="dashboard-menu">
        <?php
            if ($fun == 'index') {
                echo '<li class="active"><div class="pointer"><div class="arrow"></div><div class="arrow_border"></div></div>';
            }
            else {
                echo '<li class="">';
            }
        ?>
            <a class="tab1" href="<?php echo site_url('a/index') ?>">
                <i class="sidebar-home"></i>
                <span>引导页</span>
            </a>
        </li>
        <?php
        if ($fun == 'main') {
            echo '<li class="active"><div class="pointer"><div class="arrow"></div><div class="arrow_border"></div></div>';
        }
        else {
            echo '<li class="">';
        }
        ?>
            <a class="tab2" href="<?php echo site_url('a/main') ?>">
                <i class="sidebar-widgets"></i>
                <span>首页</span>
            </a>
        </li>
        <?php
        if ($fun == 'product') {
            echo '<li class="active"><div class="pointer"><div class="arrow"></div><div class="arrow_border"></div></div>';
        }
        else {
            echo '<li class="">';
        }
        ?>
            <a class="tab2" href="<?php echo site_url('a/product_type') ?>">
                <i class="sidebar-tables"></i>
                <span>品牌管理</span>
            </a>
        </li>
        <?php
        if ($fun == 'about') {
            echo '<li class="active"><div class="pointer"><div class="arrow"></div><div class="arrow_border"></div></div>';
        }
        else {
            echo '<li class="">';
        }
        ?>
           <a class="tab2" href="<?php echo site_url('a/about') ?>">
                <i class="sidebar-forms"></i>
                <span>关于我们</span>
            </a>
        </li>
        <?php
        if ($fun == 'store') {
            echo '<li class="active"><div class="pointer"><div class="arrow"></div><div class="arrow_border"></div></div>';
        }
        else {
            echo '<li class="">';
        }
        ?>
            <a class="tab2" href="<?php echo site_url('a/store') ?>">
                <i class="sidebar-gallery"></i>
                <span>分店</span>
            </a>
        </li>
        <?php
        if ($fun == 'press') {
            echo '<li class="active"><div class="pointer"><div class="arrow"></div><div class="arrow_border"></div></div>';
        }
        else {
            echo '<li class="">';
        }
        ?>
          <a class="tab2" href="<?php echo site_url('a/press') ?>">
                <i class="sidebar-calendar"></i>
                <span>新闻</span>
            </a>
        </li>
        <?php
        if ($fun == 'user') {
            echo '<li class="active"><div class="pointer"><div class="arrow"></div><div class="arrow_border"></div></div>';
        }
        else {
            echo '<li class="">';
        }
        ?>
            <a class="tab2" href="<?php echo site_url('a/user') ?>">
                <i class="icon-group"></i>
                <span>当前帐户</span>
            </a>
        </li>
        <?php
        if ($fun == 'config') {
            echo '<li class="active"><div class="pointer"><div class="arrow"></div><div class="arrow_border"></div></div>';
        }
        else {
            echo '<li class="">';
        }
        ?>
            <a class="tab9" href="<?php echo site_url('a/config') ?>">
                <i class="sidebar-gear"></i>
                <span>系统配置</span>
            </a>
        </li>
        <li class="">
            <a class="tab10" href="<?php echo site_url("a/login/logout") ?>">
                <i class="sidebar-logout"></i>
                <span>退出系统</span>
            </a>
        </li>
    </ul>
</div>
<!-- end sidebar -->